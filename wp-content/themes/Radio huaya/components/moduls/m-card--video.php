<?php
// ==============================
// CONSULTA PERSONALIZADA: Videos
// ==============================
$args = array(
  'post_type'      => 'Videos', // Tipo de contenido personalizad 
);

$videos_query = new WP_Query($args);
?>


<?php if ($videos_query->have_posts()): ?>
  <?php while ($videos_query->have_posts()): $videos_query->the_post(); 
  

    
  $categories = get_the_category();
  $classes = '';
  
  foreach($categories as $cat){
    $classes .= ' ' . $cat->slug;
  }
  
  ?>

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
    $video = get_field('video');
    ?>

  <article class="mix <?php echo esc_attr($classes); ?> card card--video">
   
    <!-- Encabezado visual: imagen + controles -->
    <header class="card__media">

      <!-- Reproductor de video -->
      <?php if ($video): ?>
        <?php echo ($video); ?>
      <?php endif;?>

    </header>


    <!-- Cuerpo de la nota -->
    <div class="card__body card__body--video">


      <div class="card__controls-content-video">

        <!-- Metadatos -->
        <div class="card__meta  card__meta--bg-dark">

            <span class="card__date u-tools">
              <i class="fa-solid fa-calendar-days"></i> <?php echo get_the_date('d \d\e F \d\e Y'); ?>
            </span>

            <!-- <span class="card__views u-tools">
              <i class="fa-solid fa-eye"></i> 12 Visualizaciones
            </span> -->
        </div>

        <!-- Controles superpuestos -->
        <div class="card__controls">

          <!-- botón de me gusta    -->
          <!-- <button class="card__btn card__btn--video card__btn--like" aria-label="Me gusta">
            <i class="fa-solid fa-heart"></i>
            <span>33</span>
          </button> -->

        
          <!-- Botones de compartir -->
          <div class="card__controls" role="group" aria-label="Compartir en redes sociales">
            <span class="card__btn card__btn--share" aria-label="Compartir">
              Compartir
                <a href="#" class="card__social-link" aria-label="Compartir en Facebook">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="card__social-link" aria-label="Compartir en Instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="card__social-link" aria-label="Compartir en X (Twitter)">
                <i class="fab fa-x-twitter"></i>
              </a>
            </span>
          </div>


        </div>

      </div>

      <!-- Título como enlace -->

      <h2 class="card__title  u-title--sm">
        <?php
        $title = get_the_title(); 
        $trimmed_title = wp_trim_words( $title, 6, '...' ); 
        echo $trimmed_title;
        ?>
      </h2>

      <!-- Categorias  -->
      <?php
      $rel_cats = get_the_category();
      if ($rel_cats): ?>
        <div class="card__categories u-tools">
          <?php foreach ($rel_cats as $rel_cat): ?>
            <a 
              class="card__category categories categories__cat-1" 
              href="<?php echo esc_url(get_category_link($rel_cat->term_id)); ?>"
            >
              <?php echo esc_html($rel_cat->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>


  </article>

  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>



