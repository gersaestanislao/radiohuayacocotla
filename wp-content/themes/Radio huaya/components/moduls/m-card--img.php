<?php
// ==============================
// CONSULTA PERSONALIZADA: NOTICIERO
// ==============================
$args = array(
  'post_type'      => 'Producciones', // Tipo de contenido personalizado
);

$producciones_query = new WP_Query($args);


?>


<?php if ($producciones_query->have_posts()): ?>
  <?php while ($producciones_query->have_posts()): $producciones_query->the_post(); 
  
 
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

    // ACF tipo de contenido 
    $tipo = get_field('tipo'); 

    ?>
  <!-- Slide  -->
  <article class="mix <?php echo esc_attr($classes); ?> item" role="group" aria-roledescription="slide" aria-label="1 de 2">
    <div class="card card--img">
      <!-- Encabezado visual: imagen + controles -->
      <header class="card__media">

        <!-- shadow  -->
        <div class="card__shadow"></div>


            <!-- Reproductor de audio (sin autoplay por accesibilidad) -->
            <?php if ($audio): ?>
              <audio class="audio-player" controls muted>
                <source src="<?php echo esc_url($audio); ?>" type="audio/mpeg">
                Tu navegador no soporta el elemento de audio.
              </audio>
            <?php endif;?>


            <!-- tag de tipo de contenido  -->
            <?php if ($tipo): ?>
              <div class="card__kind-type">
                  <span class="u-tools">
                    <?php echo esc_html($tipo); ?>
                  </span>
              </div>
            <?php endif;?>
        
        <!-- Imagen -->
        <figure class="frame-img card__image-frame  card__image-frame--img">
        
            <img 
                src="<?php echo esc_url($thumbnail_url); ?>" 
                alt="<?php echo esc_attr($thumbnail_alt); ?>" 
                class="card__image"
              />
        </figure>


        <!-- Cuerpo de la nota -->
        <div class="card__body card__body--img">

            <!-- Título como enlace (mejor para SEO) -->
            <h2 class="card__title card__title--img u-title-md">
                <a href="#" class="card__title-link"><?php the_title(); ?></a>
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

            <!-- Descripción breve -->
            <p class="card__descript  card__descript--img  u-texto">
              <?php
                $content = get_the_content(); 
                $trimmed_content = wp_trim_words( $content, 18, '...' ); 
                echo $trimmed_content. ' <a href="' . get_permalink() . '"><b>Ver más</a></b>';
              ?>
            </p>
        </div>

      </header>
    </div>
  </article>

<?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>



