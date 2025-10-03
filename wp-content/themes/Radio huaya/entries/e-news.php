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
  </header>



  <!-- Reproductor de video -->
  <?php if ($video): ?>
    <?php echo ($video); ?>
  <?php endif;?>

  <figure class="frame-img entry__image">
    <img 
      src="<?php echo esc_url($thumbnail_url); ?>" 
      alt="<?php echo esc_attr($thumbnail_alt); ?>" 
    />

    <!-- Reproductor de audio (sin autoplay por accesibilidad) -->
    <?php if ($audio): ?>
        <audio class="audio-player" controls muted>
            <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
            Tu navegador no soporta el elemento de audio.
        </audio>
    <?php endif;?>
  </figure>

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

<aside class="related">
  <h2 class="related__title">Más noticias</h2>

  <?php
  $current_slug = get_post_field('post_name', get_post());
  $categories   = get_the_category();
  $cat_slug     = $categories ? $categories[0]->slug : '';

  $related_args = [
    'post_type'      => get_post_type(),
    'category_name'  => $cat_slug,
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'date',
    'order'          => 'DESC',
  ];

  $related_query = new WP_Query($related_args);

  if ($related_query->have_posts()):
    while ($related_query->have_posts()): $related_query->the_post();
      $related_thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
      $related_thumb_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ?: get_the_title();
  ?>
      <article class="related__item">

      <!-- Imagen  -->
        <div class="frame-img related__frame">
          <img 
            src="<?php echo esc_url($related_thumb_url); ?>" 
            alt="<?php echo esc_attr($related_thumb_alt); ?>" 
          />
        </div>

        <!-- Título  -->
        <a href="<?php the_permalink(); ?>" class="related__link">
          <?php the_title(); ?>
        </a>

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


         <!-- Enlace a la nota completa -->
         <a href="<?php echo esc_url(get_permalink()); ?>" class="card__link link link--icon">
            Nota Completa <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
          </a>
          
        <hr>
      </article>
  <?php
    endwhile;
    wp_reset_postdata();
  endif;
  ?>

   <!-- Botón de acción -->
   <a href="/noticias" class="m-title__btn btn btn--white" role="button">
        Ver todas las noticias
    </a>

</aside>
