<?php
// ==============================
// CONSULTA PERSONALIZADA: Videos
// ==============================
$args = array(
  'post_type'      => 'Videos', // Tipo de contenido personalizad 
  'posts_per_page' => 9            // Límite de entradas a mostrar
);

$videos_query = new WP_Query($args);
?>


<?php if ($videos_query->have_posts()): ?>
  <?php while ($videos_query->have_posts()): $videos_query->the_post(); ?>

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

  <article class="card card--video">
   
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
        </div>


      </div>

      <!-- Título como enlace -->

      <p class="card__title card__title--video u-texto u-color-black">
        <?php
        $title = get_the_title(); 
        $trimmed_title = wp_trim_words( $title, 6, '...' ); 
        echo $trimmed_title;
        ?>
      </p>

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



