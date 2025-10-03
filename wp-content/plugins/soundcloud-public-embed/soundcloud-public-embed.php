<?php
/**
 * Plugin Name: SoundCloud Public Embed (sin OAuth) – v1.2.1 (diagnóstico)
 * Description: Lectura pública con client_id opcional. Shortcodes + importación desde playlists. Incluye fallback, avisos detallados y prueba de conectividad.
 * Version: 1.2.1
 * Author: Tu Equipo
 * License: GPL-2.0+
 */

if (!defined('ABSPATH')) exit;

class SC_Public_Embed {
  const OPTION = 'scpe_client_id';
  public function __construct() {
    add_action('init', [$this, 'register_cpt']);
    add_action('admin_menu', [$this, 'add_settings_page']);
    add_action('admin_init', [$this, 'register_settings']);
    add_shortcode('sc_player',   [$this, 'shortcode_player']);
    add_shortcode('sc_card',     [$this, 'shortcode_card']);
    add_shortcode('sc_playlist', [$this, 'shortcode_playlist']);
    add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    add_action('admin_post_scpe_import_playlist', [$this, 'handle_import_playlist']);
    add_action('admin_notices', [$this, 'admin_notices']);
  }

  /* ---- CPT ---- */
  public function register_cpt() {
    register_post_type('sc_track', [
      'label' => 'Tracks SoundCloud',
      'public' => false,
      'show_ui' => true,
      'menu_icon' => 'dashicons-format-audio',
      'supports' => ['title','custom-fields']
    ]);
  }

  /* ---- Ajustes ---- */
  public function add_settings_page() {
    add_options_page('SoundCloud Embed','SoundCloud Embed','manage_options','scpe-settings',[$this,'render_settings_page']);
    add_management_page('Test SoundCloud','Test SoundCloud','manage_options','scpe-test',[$this,'render_test_page']); // Herramienta de test
  }

  public function register_settings() {
    register_setting('scpe_group', self::OPTION, ['type'=>'string','sanitize_callback'=>'sanitize_text_field']);
  }

  public function render_settings_page() {
    if (!current_user_can('manage_options')) return;
    $client_id = get_option(self::OPTION, '');
    $nonce = wp_create_nonce('scpe_import');
    ?>
    <div class="wrap">
      <h1>SoundCloud Public Embed</h1>
      <p>Client ID (opcional para fallback):</p>
      <form method="post" action="options.php" style="margin-bottom:24px;">
        <?php settings_fields('scpe_group'); ?>
        <table class="form-table" role="presentation">
          <tr>
            <th scope="row"><label for="scpe_client_id">Client ID</label></th>
            <td>
              <input name="<?php echo esc_attr(self::OPTION); ?>" id="scpe_client_id" type="text" value="<?php echo esc_attr($client_id); ?>" class="regular-text" placeholder="p.ej. 4f3c..." />
              <p class="description">Puedes dejarlo vacío y el plugin usará el fallback del widget cuando sea posible.</p>
            </td>
          </tr>
        </table>
        <?php submit_button('Guardar'); ?>
      </form>

      <hr/>
      <h2>Importar playlist (set) → guardar tracks como posts</h2>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="scpe_import_playlist" />
        <input type="hidden" name="_wpnonce" value="<?php echo esc_attr($nonce); ?>" />
        <p>
          <label for="scpe_playlist_url" class="screen-reader-text">URL de la playlist</label>
          <input id="scpe_playlist_url" type="url" name="playlist_url" class="regular-text" placeholder="https://soundcloud.com/usuario/sets/mi-playlist" required />
        </p>
        <p><label><input type="checkbox" name="update_existing" value="1" checked/> Actualizar existentes</label></p>
        <?php submit_button('Importar playlist'); ?>
      </form>

      <p>Si tienes problemas, ve a <a href="<?php echo esc_url(admin_url('tools.php?page=scpe-test')); ?>">Herramientas → Test SoundCloud</a>.</p>
    </div>
    <?php
  }

  public function admin_notices() {
    if (!current_user_can('manage_options')) return;
    if (empty($_GET['scpe_msg'])) return;
    $msg = sanitize_text_field($_GET['scpe_msg']);
    echo '<div class="notice notice-info"><p><strong>SoundCloud Embed:</strong> '.esc_html($msg).'</p></div>';
  }

  /* ---- HTTP / Resolve ---- */
  private function get_client_id() { return trim((string) get_option(self::OPTION, '')); }

  private function http_get_json($url) {
    $response = wp_remote_get($url, [
      'timeout' => 20,
      'headers' => [
        'Accept' => 'application/json',
        'User-Agent' => 'Mozilla/5.0 (WordPress; +'.home_url('/').')',
      ],
    ]);
    if (is_wp_error($response)) return new WP_Error('scpe_http', $response->get_error_message());
    $code = wp_remote_retrieve_response_code($response);
    $body = wp_remote_retrieve_body($response);
    if ($code < 200 || $code >= 300) return new WP_Error('scpe_http_code', 'HTTP '.$code.' en '.$url);
    $data = json_decode($body, true);
    if (!is_array($data)) return new WP_Error('scpe_json', 'Respuesta inválida JSON');
    return $data;
  }

  private function resolve($public_url) {
    $client_id = $this->get_client_id();
    $cache_key = 'scpe_resolve_'.md5('any:'.$public_url);
    $cached = get_transient($cache_key);
    if ($cached !== false) return $cached;

    // 1) API v2 (si hay client_id)
    if ($client_id) {
      $endpoint_v2 = add_query_arg(['url'=>$public_url,'client_id'=>$client_id],'https://api-v2.soundcloud.com/resolve');
      $data = $this->http_get_json($endpoint_v2);
      if (!is_wp_error($data)) { set_transient($cache_key,$data,6*HOUR_IN_SECONDS); return $data; }
      $msg = is_wp_error($data) ? $data->get_error_message() : '';
      $should_fallback = (strpos($msg,'HTTP 401')!==false || strpos($msg,'HTTP 403')!==false);
      if (!$should_fallback) return $data;
    }

    // 2) Fallback: widget (no requiere client_id)
    $endpoint_widget = add_query_arg(['url'=>$public_url,'format'=>'json'],'https://api-widget.soundcloud.com/resolve');
    $data2 = $this->http_get_json($endpoint_widget);
    if (!is_wp_error($data2)) { set_transient($cache_key,$data2,6*HOUR_IN_SECONDS); return $data2; }

    // 3) oEmbed (parcial)
    $endpoint_oembed = add_query_arg(['format'=>'json','url'=>$public_url],'https://soundcloud.com/oembed');
    $data3 = $this->http_get_json($endpoint_oembed);
    if (!is_wp_error($data3)) { set_transient($cache_key,$data3,1*HOUR_IN_SECONDS); return $data3; }

    return $data2;
  }

  private function normalize_basic($data, $fallback_url='') {
    $permalink = isset($data['permalink_url']) ? $data['permalink_url'] : $fallback_url;
    if (!$permalink && isset($data['url'])) $permalink = $data['url'];
    $title = isset($data['title']) ? $data['title'] : (isset($data['author_name'])?$data['author_name']:'');
    $username = isset($data['user']['username']) ? $data['user']['username'] : (isset($data['username'])?$data['username']:'');
    $art = !empty($data['artwork_url']) ? $data['artwork_url']
         : (!empty($data['user']['avatar_url']) ? $data['user']['avatar_url']
         : (!empty($data['thumbnail_url']) ? $data['thumbnail_url'] : ''));
    $duration = isset($data['duration']) ? (int)$data['duration'] : 0;
    return [
      'kind'       => isset($data['kind'])?$data['kind']:'',
      'id'         => isset($data['id'])?$data['id']:'',
      'permalink'  => $permalink ?: $fallback_url,
      'title'      => $title,
      'username'   => $username,
      'artwork'    => $art,
      'duration'   => $duration,
      'waveform'   => isset($data['waveform_url'])?$data['waveform_url']:'',
      'created_at' => isset($data['created_at'])?$data['created_at']:'',
      'uri'        => isset($data['uri'])?$data['uri']:'',
    ];
  }

  private function ms_to_time($ms) { $sec = (int) round($ms/1000); return sprintf('%02d:%02d', floor($sec/60), $sec%60); }

  private function build_player_src($public_url, $args=[]) {
    $p = array_merge([
      'auto_play'=>'false','hide_related'=>'true','show_comments'=>'false','visual'=>'true','color'=>'ff5500'
    ], $args);
    return 'https://w.soundcloud.com/player/?'.http_build_query([
      'url'=>$public_url,'auto_play'=>$p['auto_play'],'hide_related'=>$p['hide_related'],'show_comments'=>$p['show_comments'],'visual'=>$p['visual'],'color'=>ltrim($p['color'],'#')
    ], '', '&');
  }

  /* ---- Shortcodes ---- */
  public function shortcode_player($atts) {
    $a = shortcode_atts(['url'=>'','autoplay'=>'false','hide_related'=>'true','show_comments'=>'false','visual'=>'true','color'=>'#ff5500'],$atts,'sc_player');
    if (empty($a['url'])) return '';
    $src = $this->build_player_src(esc_url_raw($a['url']), [
      'auto_play'=> $a['autoplay']==='true'?'true':'false',
      'hide_related'=> $a['hide_related']==='true'?'true':'false',
      'show_comments'=> $a['show_comments']==='true'?'true':'false',
      'visual'=> $a['visual']==='true'?'true':'false',
      'color'=> ltrim($a['color'],'#'),
    ]);
    return '<div class="scpe-embed" style="position:relative;padding-top:56.25%;height:0;overflow:hidden;border-radius:12px;"><iframe title="SoundCloud player" loading="lazy" allow="autoplay" style="position:absolute;inset:0;width:100%;height:100%;border:0;" src="'.esc_url($src).'"></iframe></div>';
  }

  public function shortcode_card($atts) {
    $a = shortcode_atts(['url'=>'','autoplay'=>'false','visual'=>'true'],$atts,'sc_card');
    if (empty($a['url'])) return '';
    $data = $this->resolve(esc_url_raw($a['url']));
    if (is_wp_error($data)) return current_user_can('manage_options') ? '<div class="scpe-error">Error: '.esc_html($data->get_error_message()).'</div>' : '';
    $m = $this->normalize_basic($data,$a['url']);
    $title = esc_html($m['title'] ?: 'SoundCloud'); $author = esc_html($m['username'] ?: '');
    $dur = $m['duration'] ? $this->ms_to_time($m['duration']) : ''; $art = $m['artwork'] ? esc_url($m['artwork']) : '';
    $plink = esc_url($m['permalink']);
    $src = esc_url($this->build_player_src($a['url'],['auto_play'=>$a['autoplay']==='true'?'true':'false','visual'=>$a['visual']==='true'?'true':'false']));
    ob_start(); ?>
    <div class="scpe-card" data-scpe-src="<?php echo $src; ?>" style="display:grid;grid-template-columns:96px 1fr;gap:12px;align-items:center;border:1px solid #e5e7eb;border-radius:12px;padding:12px;background:#fff;">
      <div class="scpe-card__art" style="position:relative;width:96px;height:96px;border-radius:8px;overflow:hidden;background:#111;">
        <?php if ($art): ?><img src="<?php echo $art; ?>" alt="" style="width:100%;height:100%;object-fit:cover;display:block;"/><?php endif; ?>
        <button class="scpe-card__play" type="button" aria-label="Reproducir" style="position:absolute;inset:auto 8px 8px auto;border:0;border-radius:999px;width:36px;height:36px;cursor:pointer;">▶</button>
      </div>
      <div class="scpe-card__meta" style="min-width:0;">
        <div class="scpe-card__title" style="font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><a href="<?php echo $plink; ?>" target="_blank" rel="noopener" style="text-decoration:none;color:#111;"><?php echo $title; ?></a></div>
        <?php if ($author): ?><div class="scpe-card__author" style="color:#6b7280;font-size:14px;">Por <?php echo $author; ?><?php if ($dur): ?> • <?php echo esc_html($dur); ?><?php endif; ?></div><?php endif; ?>
        <div class="scpe-card__player" style="margin-top:8px;display:none;"></div>
      </div>
    </div>
    <?php return ob_get_clean();
  }

  public function shortcode_playlist($atts) {
    $a = shortcode_atts(['url'=>'','show_player'=>'true','visual'=>'false','autoplay'=>'false','limit'=>0],$atts,'sc_playlist');
    if (empty($a['url'])) return '';
    $data = $this->resolve(esc_url_raw($a['url']));
    if (is_wp_error($data)) return current_user_can('manage_options') ? '<div class="scpe-error">Error: '.esc_html($data->get_error_message()).'</div>' : '';
    // Acepta respuestas sin 'kind' si traen tracks[]
    $is_playlist = (isset($data['kind']) && $data['kind']==='playlist') || (isset($data['tracks']) && is_array($data['tracks']));
    if (!$is_playlist) return '<div class="scpe-error">No es una playlist válida o no hay tracks públicos (resolve sin tracks).</div>';
    $tracks = isset($data['tracks']) && is_array($data['tracks']) ? $data['tracks'] : [];
    if ($a['limit']) $tracks = array_slice($tracks, 0, (int)$a['limit']);
    if (!$tracks) return '<div class="scpe-error">No se encontraron tracks en la respuesta.</div>';

    ob_start(); ?>
    <div class="scpe-list" style="display:grid;gap:16px;">
      <?php foreach ($tracks as $t):
        $m = $this->normalize_basic($t, isset($t['permalink_url'])?$t['permalink_url']:'');
        $title = esc_html($m['title']); $author = esc_html($m['username']); $plink = esc_url($m['permalink']);
        $art = $m['artwork'] ? esc_url($m['artwork']) : ''; $dur = $m['duration'] ? $this->ms_to_time($m['duration']) : '';
        $src = esc_url($this->build_player_src($m['permalink'],['auto_play'=>$a['autoplay']==='true'?'true':'false','visual'=>$a['visual']==='true'?'true':'false']));
      ?>
      <article class="scpe-item" data-scpe-src="<?php echo $src; ?>" style="display:grid;grid-template-columns:88px 1fr;gap:12px;border:1px solid #e5e7eb;border-radius:12px;padding:12px;background:#fff;">
        <div class="scpe-item__art" style="width:88px;height:88px;border-radius:8px;overflow:hidden;background:#111;position:relative;">
          <?php if ($art): ?><img src="<?php echo $art; ?>" alt="" style="width:100%;height:100%;object-fit:cover;display:block;" /><?php endif; ?>
          <?php if ($a['show_player'] === 'true'): ?><button class="scpe-card__play" type="button" aria-label="Reproducir" style="position:absolute;right:8px;bottom:8px;border:0;border-radius:999px;width:32px;height:32px;cursor:pointer;">▶</button><?php endif; ?>
        </div>
        <div class="scpe-item__meta" style="min-width:0;">
          <h4 style="margin:0 0 4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><a href="<?php echo $plink; ?>" target="_blank" rel="noopener" style="text-decoration:none;color:#111;"><?php echo $title; ?></a></h4>
          <div style="color:#6b7280;font-size:14px;">Por <?php echo $author; ?><?php if ($dur): ?> • <?php echo esc_html($dur); ?><?php endif; ?></div>
          <?php if ($a['show_player'] === 'true'): ?><div class="scpe-card__player" style="margin-top:8px;display:none;"></div><?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php return ob_get_clean();
  }

  /* ---- Importador ---- */
  public function handle_import_playlist() {
    if (!current_user_can('manage_options') || !check_admin_referer('scpe_import')) wp_die('Permisos inválidos');
    $url = isset($_POST['playlist_url']) ? esc_url_raw($_POST['playlist_url']) : '';
    $update = !empty($_POST['update_existing']);
    if (!$url) { wp_redirect(add_query_arg('scpe_msg','no_url', wp_get_referer())); exit; }

    $data = $this->resolve($url);
    if (is_wp_error($data)) { wp_redirect(add_query_arg('scpe_msg','resolve_error', wp_get_referer())); exit; }

    $tracks = (isset($data['tracks']) && is_array($data['tracks'])) ? $data['tracks'] : [];
    if (!$tracks) { wp_redirect(add_query_arg('scpe_msg','bad_playlist_no_tracks', wp_get_referer())); exit; }

    $count = 0;
    foreach ($tracks as $t) { $this->upsert_track_post($t, $update); $count++; }
    wp_redirect(add_query_arg('scpe_msg','import_ok_'.$count, wp_get_referer())); exit;
  }

  private function upsert_track_post($track, $update_existing=true) {
    $sc_id = isset($track['id']) ? (string)$track['id'] : '';
    if (!$sc_id) return;
    $existing = get_posts(['post_type'=>'sc_track','meta_key'=>'sc_id','meta_value'=>$sc_id,'post_status'=>'any','numberposts'=>1,'fields'=>'ids']);
    $m = $this->normalize_basic($track, isset($track['permalink_url'])?$track['permalink_url']:'');
    $postarr = ['post_type'=>'sc_track','post_status'=>'publish','post_title'=>wp_strip_all_tags($m['title'] ?: ('Track '.$sc_id))];
    if ($existing) { if (!$update_existing) return; $postarr['ID']=$existing[0]; $post_id = wp_update_post($postarr, true); }
    else { $post_id = wp_insert_post($postarr, true); }
    if (is_wp_error($post_id) || !$post_id) return;
    update_post_meta($post_id,'sc_id',$sc_id);
    update_post_meta($post_id,'sc_permalink',$m['permalink']);
    update_post_meta($post_id,'sc_username',$m['username']);
    update_post_meta($post_id,'sc_duration',(int)$m['duration']);
    update_post_meta($post_id,'sc_artwork',$m['artwork']);
    update_post_meta($post_id,'sc_waveform',$m['waveform']);
    update_post_meta($post_id,'sc_created_at',$m['created_at']);
  }

  /* ---- Assets ---- */
  public function enqueue_assets() {
    wp_register_script('scpe-js', plugins_url('scpe.js', __FILE__), [], '1.2.1', true);
    wp_add_inline_script('scpe-js', 'window.SCPE_DATA = {"selector":".scpe-card, .scpe-item"};', 'before');
    if (is_singular()) { global $post; if ($post && (has_shortcode($post->post_content,'sc_card') || has_shortcode($post->post_content,'sc_player') || has_shortcode($post->post_content,'sc_playlist'))) { wp_enqueue_script('scpe-js'); } }
  }

  /* ---- Herramienta de Test ---- */
  public function render_test_page() {
    if (!current_user_can('manage_options')) return;
    $url = isset($_POST['test_url']) ? esc_url_raw($_POST['test_url']) : '';
    $out = '';
    if ($url) {
      $data = $this->resolve($url);
      if (is_wp_error($data)) {
        $out = '<p><strong>Error:</strong> '.esc_html($data->get_error_message()).'</p>';
      } else {
        $tracks = (isset($data['tracks']) && is_array($data['tracks'])) ? count($data['tracks']) : 0;
        $kind = isset($data['kind']) ? $data['kind'] : '(sin kind)';
        $out = '<p><strong>kind:</strong> '.esc_html($kind).' — <strong>tracks:</strong> '.esc_html($tracks).'</p>';
        if ($tracks && isset($data['tracks'][0])) {
          $sample = array_intersect_key($data['tracks'][0], array_flip(['id','title','permalink_url','duration']));
          $out .= '<pre>'.esc_html(print_r($sample, true)).'</pre>';
        }
      }
    }
    ?>
    <div class="wrap">
      <h1>Test SoundCloud</h1>
      <form method="post">
        <p><input type="url" name="test_url" class="regular-text" placeholder="https://soundcloud.com/usuario/sets/mi-playlist" value="<?php echo esc_attr($url); ?>" required /></p>
        <?php submit_button('Probar resolve'); ?>
      </form>
      <div><?php echo $out; ?></div>
      <hr/><p>Versión del plugin: <code>1.2.1</code></p>
    </div>
    <?php
  }
}

new SC_Public_Embed();

/* ---- JS inline (endpoint virtual) ---- */
add_action('plugins_loaded', function(){
  add_action('init', function(){
    if (isset($_GET['scpe_js'])) {
      header('Content-Type: application/javascript; charset=UTF-8'); ?>
      (function(){
        function load(h, src){ if(!h||h.dataset.loaded) return; h.style.display='block'; var w=document.createElement('div'); w.style.position='relative'; w.style.paddingTop='56.25%'; w.style.height='0'; w.style.overflow='hidden'; w.style.borderRadius='12px'; var f=document.createElement('iframe'); f.title='SoundCloud player'; f.loading='lazy'; f.allow='autoplay'; f.style.position='absolute'; f.style.inset='0'; f.style.width='100%'; f.style.height='100%'; f.style.border='0'; f.src=src; w.appendChild(f); h.appendChild(w); h.dataset.loaded='1'; }
        function mount(el){ if(el.dataset.mounted) return; el.dataset.mounted='1'; var btn=el.querySelector('.scpe-card__play'); var h=el.querySelector('.scpe-card__player')||el.querySelector('.scpe-item__player'); var src=el.getAttribute('data-scpe-src'); if(btn&&h&&src) btn.addEventListener('click', function(){ load(h,src); }, {once:true}); if('IntersectionObserver' in window && h && src){ var io=new IntersectionObserver(function(es){ es.forEach(function(e){ if(e.isIntersecting) load(h,src); }); }, {rootMargin:'200px'}); io.observe(el); } }
        function init(){ document.querySelectorAll('.scpe-card, .scpe-item').forEach(mount); }
        if(document.readyState==='loading') document.addEventListener('DOMContentLoaded', init); else init();
      })();
      <?php exit; }
  });
  add_filter('plugins_url', function($url, $path, $plugin){ if (false !== strpos((string)$path,'scpe.js')) { return add_query_arg('scpe_js','1',home_url('/')); } return $url; }, 10, 3);
});
