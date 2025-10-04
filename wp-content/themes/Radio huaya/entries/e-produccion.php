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
$tipo = get_field('tipo');

?>

<!-- Contenido -->
<article class="entry entry--audios">
    
    <!-- breadcrumbs -->
    <?php get_template_part('breadcrumbs'); ?>

    <!-- Imagen del la producción  -->
    <header class="entry__header  entry__header--audio">
      <figure class="frame-img entry__image entry__image--audio">
          <img 
            src="<?php echo esc_url($thumbnail_url); ?>" 
            alt="<?php echo esc_attr($thumbnail_alt); ?>" 
          />
      </figure>

      <!-- tag de tipo de contenido  -->
        <?php if ($tipo): ?>
          <div class="card__kind-type">
              <span class="u-tools">
                <?php echo esc_html($tipo); ?>
              </span>
          </div>
      <?php endif;?>
    </header>




    <!-- Título de la imagen  -->
    <h1 class=" entry__title u-title">
      <?php the_title(); ?>
    </h1>

    <!-- Categorias  -->
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

    <!-- Contenido de la programa  -->
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

<!-- Episodios -->
<aside class="related related--audios">

    <!-- Cabecera  -->
    <h2 class="related__title">12 Episodios</h2>

    <select class="related__select btn btn--white" name="temporada" id="myDropdown">
      <option>Temporada 1</option>
        <option>Temporada 2</option>
    </select>

    <!-- Audio -->
    <article class="related__item related__item--audio">
      <h3 class="related__audio-descript related__audio-descript--audio">Título del episodio 1</h3>
        <!-- Reproductor de audio personalizado -->
        <div class="audio-player audio-player--audio">
        <button class="audio-player__play" aria-label="Reproducir">
            <i class="fa-solid fa-play"></i>
        </button>

        <input
            type="range"
            class="audio-player__progress"
            min="0"
            max="100"
            value="0"
            aria-label="Barra de progreso" />

        <span class="audio-player__time">10:00</span>

        <i class="fa-solid fa-volume-high audio-player__volume-icon" aria-hidden="true"></i>
        <input
            type="range"
            class="audio-player__volume"
            min="0"
            max="1"
            step="0.01"
            value="1"
            aria-label="Volumen" />
        </div>

        <!-- Elemento de audio HTML5 oculto -->
        <audio class="audio-player__element" src="audio/archivo.mp3"></audio>
    </article> 
</aside>
