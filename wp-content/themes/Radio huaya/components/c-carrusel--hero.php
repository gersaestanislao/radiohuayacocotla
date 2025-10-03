<?php 
  // =====================
  // VARIABLES DEL BLOQUE
  // =====================

  // Campo opcional para usar un texto descriptivo general del módulo
  $decriptivo_del_modulo = get_sub_field('decriptivo_del_modulo');
  $visibilidad = get_sub_field('visibilidad');
?>

<!-- Sección principal del carrusel, con clases específicas para Owl Carousel y accesibilidad -->
<section class="carousel owl-carousel owl--hero owl-theme <?php echo esc_html($visibilidad); ?>"
 aria-label="<?php echo esc_html($decriptivo_del_modulo); ?>">

  <?php if (have_rows('carrusel_hero')): ?>
    
    <?php while (have_rows('carrusel_hero')): the_row(); 

      // =====================
      // VARIABLES POR SLIDE
      // =====================

      // Título del slide
      $titulo       = get_sub_field('titulo');

      // Descripción del slide
      $descriptivo = get_sub_field('descriptivo'); // Nota: revisar en ACF si el slug correcto es "descriptivo"

      // Imagen de fondo del slide
      $imagen         = get_sub_field('imagen');

      // Enlace del botón
      $link        = get_sub_field('link');

      // Texto del botón
      $texto_del_boton      = get_sub_field('texto_del_boton');

      // Destino del enlace (por ejemplo: _blank, _self)
      $target      = get_sub_field('target'); // Nota: corregir en ACF a "target_link" si es posible
    ?>

      <!-- Artículo individual (slide), con imagen de fondo y marcado ARIA para accesibilidad -->
      <article
        class="item u-text-center u-color-white"
        style="background-image: url('<?php echo esc_url($imagen); ?>');" 
        role="group"
        aria-roledescription="slide"
      >

        <!-- Contenido interno del slide -->
        <div class="carousel__content">

          <!-- Título del slide -->
          <?php if ($titulo): ?>
            <h1 class="carousel__title u-display"><?php echo esc_html($titulo); ?></h1>
          <?php endif; ?>

          <!-- Descripción del slide (limitada a 12 palabras) -->
          <?php if ($descriptivo): ?>
            <p class="carousel__desc u-texto-lg">
              <?php echo esc_html(wp_trim_words($descriptivo, 12, '...')); ?>
            </p>
          <?php endif; ?>

          <!-- Botón con enlace (si se proporciona link y texto) -->
          <?php if ($link): ?>
            <a 
              target="<?php echo esc_attr($target); ?>"
              href="<?php echo esc_url($link); ?>" 
              class="btn btn--white btn--break"
            >
              <?php echo esc_html($texto_del_boton); ?>
            </a>
          <?php endif; ?>

        </div> <!-- /.carousel__content -->
      </article>

    <?php endwhile; ?>
    
  <?php endif; ?>
</section>
