<?php
// ==========================
// DATOS DEL POST
// ==========================
$thumbnail_id  = get_post_thumbnail_id();
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: get_the_title();

// ==========================
// CAMPOS PERSONALIZADOS (ACF)
// ==========================
$descriptivo = get_field('descriptivo');
$video = get_field('video');
?>

<article class="entry">

  <?php get_template_part('breadcrumbs'); ?>

  <header class="entry__header">
    <div class="entry__meta meta-posts">
      <span class="card__date u-tools">
        <i class="fa-solid fa-calendar-days"></i> 
        <?php echo esc_html(get_the_date('d \d\e F \d\e Y')); ?>
      </span>
    </div>

    <h1 class="entry__title u-title"><?php the_title(); ?></h1>

  </header>
  
  <!-- Reproductor de video -->
  <?php if ($video): ?>
    <?php echo ($video); ?>
  <?php endif;?>



<!-- Contenido  -->
  <div class="entry__content">
    <?php the_content(); ?>
    <p><?php echo wp_kses_post($descriptivo); ?></p>
  </div>


  <!-- Botones de compartir -->
  <div class="entry__interactions card__controls entry__controls" role="group" aria-label="Compartir en redes sociales">
    <span class="card__btn card__btn--share" aria-label="Compartir">
      Compartir
      <a href="#" class="card__social-link" aria-label="Compartir en Facebook"><i class="fab fa-facebook"></i></a>
      <a href="#" class="card__social-link" aria-label="Compartir en Instagram"><i class="fab fa-instagram"></i></a>
      <a href="#" class="card__social-link" aria-label="Compartir en X (Twitter)"><i class="fab fa-x-twitter"></i></a>
    </span>
  </div>

</article>
