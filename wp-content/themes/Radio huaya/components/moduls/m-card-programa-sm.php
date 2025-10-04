<?php if (mb_strtolower($diaConAcento, 'UTF-8') === mb_strtolower($diaPost, 'UTF-8')) : ?>


<?php   
if (have_rows('programa', $post_id)): ?>
  <?php while (have_rows('programa', $post_id)): the_row(); 

    // ==========================
    // VARIABLES DE CADA PROGRAMA
    // ==========================

    $titulo      = get_sub_field('titulo');
    $descriptivo = get_sub_field('descriptivo'); 
    $link        = get_sub_field('link');
    $inicio      = get_sub_field('inicio');
    $fin         = get_sub_field('fin');
    $genero      = get_sub_field('genero');
    // ==========================
    // TEXTO DEL GÉNERO
    // ==========================

    $text_genero = 'Programa'; // Valor por defecto

    switch ($genero) {
      case 'novela':
        $text_genero = 'Radio Novela';
        break;
      case 'informativo':
        $text_genero = 'Informativo';
        break;
      case 'avisos':
        $text_genero = 'Avisos';
        break;
      case 'musica':
        $text_genero = 'Música';
        break;
      case 'contenido':
        $text_genero = 'Contenido';
        break;
      case 'radio-revista':
        $text_genero = 'Radiorevista';
        break;
    }
  ?>

        <!-- Slide individual -->
        <article
          class="programacion-carousel__item"
          role="group"
          aria-label="<?php echo esc_attr($descriptivo); ?>"
          data-hora-inicio="<?php echo esc_attr($inicio); ?>"
          data-hora-fin="<?php echo esc_attr($fin); ?>"
        >
          <!-- Etiqueta de género -->
          <span class="programacion-carousel__etiqueta programacion-carousel__etiqueta--<?php echo esc_attr($genero); ?>">
            <?php echo esc_html($text_genero); ?>
          </span>

          <!-- Descripción del programa -->
          <div class="programacion-carousel__descrption">
            <span class="programacion-carousel__hora">
              <?php echo esc_html($inicio); ?> - <?php echo esc_html($fin); ?> <a class="programacion-carousel__envivo">En vivo ahora</a>
            </span>
            <h3 class="programacion-carousel__titulo">
              <?php echo esc_html($titulo); ?>
            </h3>
          </div>
        </article>

      <?php endwhile; ?>
    <?php endif; ?>

   <?php endif; ?>
