<?php
// ==============================
// CONSULTA PERSONALIZADA: NOTICIERO
// ==============================
$args = array(
  'post_type'      => 'Noticiero', // Tipo de contenido personalizado
  'posts_per_page' => 2            // Límite de entradas a mostrar
);

$noticiero_query = new WP_Query($args);
?>

<?php if ($noticiero_query->have_posts()): ?>
  <?php while ($noticiero_query->have_posts()): $noticiero_query->the_post(); ?>

    <?php
    // ==========================
    // DATOS DEL POST
    // ==========================

    // ID de imagen destacada
    $thumbnail_id  = get_post_thumbnail_id();
    // URL de la imagen (tamaño medio)
    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    // Texto alternativo (ALT)
    $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

    // Si no existe ALT, usamos el título del post como fallback accesible
    if (!$thumbnail_alt) {
      $thumbnail_alt = get_the_title();
    }

    // ==========================
    // CAMPOS PERSONALIZADOS (ACF)
    // ==========================
    $audio = get_field('audio');
    ?>
   

      <article class="card card--bg-light">
        
        <!-- ========== ENCABEZADO VISUAL ========== -->
        <header class="card__media">
          
          <figure class="frame-img card__image-frame">
            <img 
              src="<?php echo esc_url($thumbnail_url); ?>" 
              alt="<?php echo esc_attr($thumbnail_alt); ?>" 
              class="card__image"
            />
          </figure>

          <!-- Botones de compartir -->
          <div class="card__controls" role="group" aria-label="Compartir en redes sociales">
            <span class="card__btn card__btn--share" aria-label="Compartir">
          
          
  Compartir

                  <a 
                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    aria-label="Compartir en Facebook"
                    class="share__link"
                  >
                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                  </a>

                  <a 
                    href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    aria-label="Compartir en X"
                    class="share__link"
                  >
                    <i class="fab fa-x-twitter" aria-hidden="true"></i>
                  </a>
          </span>
          
          </div>

          <!-- Reproductor de audio (sin autoplay por accesibilidad) -->
           <?php if ($audio): ?>
            <audio class="audio-player" controls muted>
              <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
              Tu navegador no soporta el elemento de audio.
            </audio>
          <?php endif;?>

        </header>

        <!-- ========== CONTENIDO DEL POST ========== -->
        <div class="card__body">
          
          <!-- Fecha de publicación -->
          <div class="card__meta">
            <span class="card__date u-tools">
              <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
              <?php echo get_the_date('d \d\e F \d\e Y'); ?>
            </span>
          </div>

          <!-- Título con enlace -->
          <h2 class="card__title u-title-sm">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="card__title-link">
              <?php
              $title = get_the_title(); 
              $trimmed_title = wp_trim_words( $title, 16, '...' ); 
              echo $trimmed_title;
              ?>
            </a>
          </h2>

          <!-- Categorías -->
          <?php
          $categories = get_the_category();
          if ($categories): ?>
            <div class="card__categories u-tools">
              <?php foreach ($categories as $category): ?>
                <a 
                  class="card__category categories categories__cat-1" 
                  href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                >
                  <?php echo esc_html($category->name); ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Contenido  -->
          <p class="card__descript u-texto">
            <?php
              $content = get_the_content(); 
              $trimmed_content = wp_trim_words( $content, 12, '...' ); 
              echo $trimmed_content;
              ?>
          </p>

          <!-- Enlace a la nota completa -->
          <a href="<?php echo esc_url(get_permalink()); ?>" class="card__link link link--icon">
            Nota Completa <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
          </a>

        </div>
        
      </article>


  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
