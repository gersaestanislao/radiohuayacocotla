<?php
// =====================
// VARIABLES DEL BLOQUE
// =====================
$descriptivo_del_modulo   = get_sub_field('descriptivo_del_modulo');
$visibilidad              = get_sub_field('visibilidad');
$tipo_layout              = get_sub_field('tipo_layout');

// Si necesitas estos en los títulos oscuros/claros (se usan dentro de los includes)
$titulo_del_componente    = get_sub_field('titulo_del_componente');
$descriptivo_del_componente = get_sub_field('descriptivo_del_componente');
$link                     = get_sub_field('link');
$texto_del_link           = get_sub_field('texto_del_link');

// =====================
// DATOS: días de semana
// =====================
// slug => [Título visible, Inicial]
$dias = [
  'lunes'     => ['Lunes', 'L'],
  'martes'    => ['Martes', 'M'],
  'miercoles' => ['Miércoles', 'M'],
  'jueves'    => ['Jueves', 'J'],
  'viernes'   => ['Viernes', 'V'],
  'sabado'    => ['Sábado', 'S'],
  'domingo'   => ['Domingo', 'D'],
];

// =====================
// HELPER: texto de género
// =====================
function rh_texto_genero($genero) {
  switch ($genero) {
    case 'novela':         return 'Radio Novela';
    case 'informativo':    return 'Informativo';
    case 'avisos':         return 'Avisos';
    case 'musica':         return 'Música';
    case 'contenido':      return 'Contenido';
    case 'radio-revista':  return 'Radiorevista';
    default:               return 'Programa';
  }
}
?>

<!-- Carrusel de noticias accesible utilizando Owl Carousel -->
<section
  class="carrusel-img w-section w-section--bg-<?php echo esc_attr($tipo_layout); ?> w-section--content-carrusel <?php echo esc_attr($visibilidad); ?>"
  aria-label="<?php echo esc_attr($descriptivo_del_modulo); ?>"
>
      <!-- Módulo de titulo de sección -->
      <?php if ($tipo_layout == 'dark'): ?>
        <?php include('moduls/m-title--dark.php'); ?>
        <?php else: ?>
         <?php include('moduls/m-title.php'); ?> 
      <?php endif; ?>

  <!-- Tablist -->
  <div class="tabs" role="tablist">
    <div class="tabs__content">
      <?php
      $i = 1;
      foreach ($dias as $slug => [$label, $initial]):
        // El primero va seleccionado por accesibilidad
        $is_active = ($i === 1);
      ?>
        <button
          id="tab<?php echo $i; ?>"
          role="tab"
          class="tabs__tab"
          aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
          aria-controls="panel<?php echo $i; ?>"
          tabindex="<?php echo $is_active ? '0' : '-1'; ?>"
        >
          <p class="u-text"><?php echo esc_html($label); ?></p>
          <small class="u-tool"><?php echo esc_html($initial); ?></small>
        </button>
      <?php
        $i++;
      endforeach; ?>
    </div>

    <?php
    // ==========================
    // PANELS (uno por día)
    // ==========================
    $i = 1;
    foreach ($dias as $slug => [$label]):

      // Query única por día (slug del CPT programacion)
      $programacion_query = new WP_Query([
        'post_type'      => 'programacion',
        'name'           => $slug,   // slug único por día
        'posts_per_page' => 1,       // explícito
      ]);
    ?>
      <div
        id="panel<?php echo $i; ?>"
        class="tabs__panel"
        role="tabpanel"
        aria-labelledby="tab<?php echo $i; ?>"
        <?php echo ($i === 1) ? '' : 'hidden'; ?>
      >
        <?php if ($programacion_query->have_posts()): ?>
          <?php while ($programacion_query->have_posts()): $programacion_query->the_post(); ?>
            <?php $post_id = get_the_ID(); ?>

            <div class="owl-carousel owl--news owl--program owl-theme" aria-label="Carrusel de programación de <?php echo esc_attr($label); ?>">
              <?php if (have_rows('programa')): ?>
                <?php while (have_rows('programa')): the_row(); 
                  // Subcampos ACF del programa
                  $titulo       = get_sub_field('titulo');
                  $descriptivo  = get_sub_field('descriptivo');
                  $link_prog    = get_sub_field('link');
                  $inicio       = get_sub_field('inicio');
                  $fin          = get_sub_field('fin');
                  $genero       = get_sub_field('genero');
                  $text_genero  = rh_texto_genero($genero);
                ?>
                  <!-- Slide -->
                  <article class="item" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr($titulo ?: 'Programa'); ?>">
                    <!-- Carga del módulo de card (usa variables arriba) -->
                      <?php include('moduls/m-card--programa.php'); ?> 
                  </article>
                <?php endwhile; ?>
              <?php else: ?>
                <p class="u-tool">No hay programas cargados para este día.</p>
              <?php endif; ?>
            </div>

          <?php endwhile; wp_reset_postdata(); ?>
        <?php else: ?>
          <p class="u-tool">No se encontró la página de programación para “<?php echo esc_html($label); ?>”.</p>
        <?php endif; ?>
      </div>
    <?php
      $i++;
    endforeach; ?>
  </div>
</section>
