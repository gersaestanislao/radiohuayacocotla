<?php
// ==============================
// CONSULTA PERSONALIZADA: NOTICIERO
// ==============================
$args = array(
  'post_type'      => 'Noticiero', // Tipo de contenido personalizado
  'posts_per_page' => 3 ,           // Límite de entradas a mostrar
  'offset'         => 2 ,           // Saltar los 2 primeros
);

$noticiero_query = new WP_Query($args);
?>

<?php if ($noticiero_query->have_posts()): ?>
  <?php while ($noticiero_query->have_posts()): $noticiero_query->the_post(); ?>



      <!-- Noticia secundaria -->
      <article class="noticiero__item">
         
         <div class="noticiero__content">



            <h3 class="noticiero__headline">
                <a href="<?php echo esc_url(get_permalink()); ?>" class="card__title-link">
                    <?php
                        $title = get_the_title(); 
                        $trimmed_title = wp_trim_words( $title, 16, '...' ); 
                        echo $trimmed_title;
                    ?>
                </a>
            </h3>
        
            <!-- Fecha de publicación -->
            <div class="card__meta">
                <span class="card__date u-tools">
                <i class="fa-solid fa-calendar-days" aria-hidden="true"></i>
                <?php echo get_the_date('d \d\e F \d\e Y'); ?>
                </span>
            </div>

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


         </div>
     </article>

   
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>
