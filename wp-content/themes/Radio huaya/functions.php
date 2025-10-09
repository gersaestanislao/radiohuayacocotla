<?php

add_theme_support('templates');
// Registro support----------------------------------------
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array(
  'aside',
  'image',
  'video',
  'quote',
  'link',
  'gallery',
  'status',
  'audio',
  'chat',
) );

// Registro de post
add_action('init', 'Noticiero');
function Noticiero() {
  register_post_type( 'Noticiero', array(
  'labels' => array(
  'name' => __('Noticiero'),
  'singular_name' => __('Crear Noticia')
  ),
  'public' => true,
  'show_ui' => true,
  'rewrite' => array(
  'slug' => 'Noticiero',
  'with_front' => false
  ),
  'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
  'has_archive' => true,
  'taxonomies' => array('category', 'post_tag'),
  'exclude_from_search' => false,
  ) );
}


// Registro de post
add_action('init', 'Programacion');
function Programacion() {
  register_post_type( 'Programacion', array(
  'labels' => array(
  'name' => __('Programacion'),
  'singular_name' => __('Crear Programa')
  ),
  'public' => true,
  'show_ui' => true,
  'rewrite' => array(
  'slug' => 'Programacion',
  'with_front' => false
  ),
  'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
  'has_archive' => true,
  'taxonomies' => array('category', 'post_tag'),
  'exclude_from_search' => false,
  ) );
}


// Registro de post
add_action('init', 'Producciones');
function Producciones() {
  register_post_type( 'Producciones', array(
  'labels' => array(
  'name' => __('Producciones'),
  'singular_name' => __('Crear Producción')
  ),
  'public' => true,
  'show_ui' => true,
  'rewrite' => array(
  'slug' => 'Producciones',
  'with_front' => false
  ),
  'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
  'has_archive' => true,
  'taxonomies' => array('category', 'post_tag'),
  'exclude_from_search' => false,
  ) );
}


// Registro de post
add_action('init', 'Videos');
function Videos() {
  register_post_type( 'Videos', array(
  'labels' => array(
  'name' => __('Videos'),
  'singular_name' => __('Crear Video')
  ),
  'public' => true,
  'show_ui' => true,
  'rewrite' => array(
  'slug' => 'Videos',
  'with_front' => false
  ),
  'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
  'has_archive' => true,
  'taxonomies' => array('category', 'post_tag'),
  'exclude_from_search' => false,
  ) );
}

// Aumenta el contador de vistas
function rh_sumar_vista_post($post_id) {
  if (!is_single()) return;

  if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
  }

  $vistas = get_post_meta($post_id, 'rh_vistas', true);
  $vistas = $vistas ? intval($vistas) : 0;
  $vistas++;

  update_post_meta($post_id, 'rh_vistas', $vistas);
}

// Ejecutar al cargar una nota
function rh_contador_vistas_single() {
  if (is_single()) {
    global $post;
    rh_sumar_vista_post($post->ID);
  }
}

add_action('wp_head', 'rh_contador_vistas_single');
//Limitar con la funcion get_the_content
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
  array_pop($content);
  $content = implode(" ",$content).'...';
  } else {
  $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
/**
 * Añade etiquetas Open Graph y Twitter Card para compartir en redes sociales.
 */
function rh_add_social_meta_tags() {
  if ( is_singular() ) { // Solo en posts o páginas individuales
      global $post;

      $title       = esc_attr( get_the_title( $post ) );
      $description = esc_attr( wp_strip_all_tags( get_the_excerpt( $post ) ) );
      $url         = esc_url( get_permalink( $post ) );

      // Imagen destacada o una imagen por defecto
      if ( has_post_thumbnail( $post ) ) {
          $image = esc_url( get_the_post_thumbnail_url( $post, 'large' ) );
      } else {
          $image = esc_url( get_template_directory_uri() . '/images/default-og.jpg' );
      }

      // Nombre del sitio
      $site_name = esc_attr( get_bloginfo( 'name' ) );
      ?>
      <!-- ============================= -->
      <!-- META TAGS PARA REDES SOCIALES -->
      <!-- ============================= -->

      <!-- Facebook / Instagram (Open Graph) -->
      <meta property="og:type" content="article" />
      <meta property="og:site_name" content="<?php echo $site_name; ?>" />
      <meta property="og:title" content="<?php echo $title; ?>" />
      <meta property="og:description" content="<?php echo $description; ?>" />
      <meta property="og:url" content="<?php echo $url; ?>" />
      <meta property="og:image" content="<?php echo $image; ?>" />

      <!-- Twitter Card -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="<?php echo $title; ?>" />
      <meta name="twitter:description" content="<?php echo $description; ?>" />
      <meta name="twitter:image" content="<?php echo $image; ?>" />

      <!-- Meta genérica -->
      <meta name="description" content="<?php echo $description; ?>" />
      <?php
  }
}
add_action( 'wp_head', 'rh_add_social_meta_tags', 5 );


?>

