<?php
  // =====================
  // VARIABLES DEL BLOQUE
  // =====================

  // Campo opcional para usar un texto descriptivo general del módulo
  $descriptivo_del_modulo = get_sub_field('descriptivo_del_modulo');
  $visibilidad = get_sub_field('visibilidad');
// === Obtener subcampos de columnas usando ACF ===

// Utilidad para obtener subcampos de una columna
function get_column_data($prefix) {
  return [
    'titulo'     => get_sub_field("titulo$prefix"),
    'imagen'       => get_sub_field("imagen$prefix"),
    'video'     => get_sub_field("video$prefix"),
    'subtitulo'  => get_sub_field("subtitulo$prefix"),
    'descriptivo'      => get_sub_field("descriptivo$prefix"),
    'link'      => get_sub_field("link$prefix"),
    'etiqueta'       => get_sub_field("etiqueta$prefix"),
    'sombra'    => get_sub_field("sombra$prefix"),
  ];
}

// Obtener datos de cada columna
$col1 = get_column_data('coluno');
$col2 = get_column_data('coldos');
$col3 = get_column_data('coltres');
$col4 = get_column_data('colcuatro');
?>


<section class="flex-grid <?php echo esc_html($visibilidad); ?>" aria-label="<?php echo esc_html($descriptivo_del_modulo); ?>">

  <!-- :: Columna 1 -->
  <article 
   onclick="location.href='<?php echo esc_url($col1['link']); ?>'"
   class="flex-grid__col col--4" 
   style="background-image: url('<?php echo esc_url($col1['imagen']); ?>');" 
   aria-label="<?php echo esc_attr($col1['titulo']); ?>">
   
    <?php if ($col1['video']) : ?>
      <video autoplay muted loop class="flex-grid__video" aria-hidden="true">
        <source src="<?php echo esc_url($col1['video']); ?>" type="video/mp4">
      </video>
    <?php endif; ?>
   
    <?php if ($col1['sombra'])  : ?>
        <div class="flex-grid__shadow" aria-hidden="true"></div>
    <?php endif; ?>

    <?php if ($col1['etiqueta']) : ?>
      <span class="flex-grid__tag"><?php echo esc_html($col1['etiqueta']); ?></span>
    <?php endif; ?>

    <div class="flex-grid__wrap">
      <?php if ($col1['subtitulo']) : ?><small class="flex-grid__subtitle"><?php echo esc_html($col1['subtitulo']); ?></small><?php endif; ?>
      <h2 class="flex-grid__title"><?php echo esc_html($col1['titulo']); ?></h2>
      
      <p class="flex-grid__description">
       <?php echo esc_html(wp_trim_words($col1['descriptivo'], 8, '...')); ?>
      </p>
    </div>

    <?php if ($col1['link']) : ?>
      <a class="flex-grid__link" href="<?php echo esc_url($col1['link']); ?>" aria-label="Leer más sobre <?php echo esc_attr($col1['titulo']); ?>">
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    <?php endif; ?>
  </article>

  <!-- :: Columna 2 y 3 agrupadas -->
  <div class="flex-grid__col col--4-content">

    <!-- :: Columna 2 -->
    <article 
    onclick="location.href='<?php echo esc_url($col2['link']); ?>'"
    class="flex-grid__row" style="background-image: url('<?php echo esc_url($col2['imagen']); ?>');" aria-label="<?php echo esc_attr($col2['titulo']); ?>">
      <?php if ($col2['video']) : ?>
        <video autoplay muted loop class="flex-grid__video" aria-hidden="true">
          <source src="<?php echo esc_url($col2['video']); ?>" type="video/mp4">
        </video>
      <?php endif; ?>
       
    <?php if ($col2['sombra'])  : ?>
        <div class="flex-grid__shadow" aria-hidden="true"></div>
    <?php endif; ?>

    <?php if ($col2['etiqueta']) : ?>
      <span class="flex-grid__tag"><?php echo esc_html($col2['etiqueta']); ?></span>
    <?php endif; ?>

      <div class="flex-grid__wrap">
        <?php if ($col2['subtitulo']) : ?><small class="flex-grid__subtitle"><?php echo esc_html($col2['subtitulo']); ?></small><?php endif; ?>
        <h2 class="flex-grid__title"><?php echo esc_html($col2['titulo']); ?></h2>
        <p class="flex-grid__description">
        <?php echo esc_html(wp_trim_words($col2['descriptivo'], 8, '...')); ?>
        </p>
        
      </div>

      <?php if ($col2['link']) : ?>
        <a class="flex-grid__link" href="<?php echo esc_url($col2['link']); ?>" aria-label="Leer más sobre <?php echo esc_attr($col2['titulo']); ?>">
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      <?php endif; ?>
    </article>

    <!-- :: Columna 3 -->
    <article 
    onclick="location.href='<?php echo esc_url($col3['link']); ?>'"
    class="flex-grid__row" style="background-image: url('<?php echo esc_url($col3['imagen']); ?>');" aria-label="<?php echo esc_attr($col3['titulo']); ?>">
      <?php if ($col3['video']) : ?>
        <video autoplay muted loop class="flex-grid__video" aria-hidden="true">
          <source src="<?php echo esc_url($col3['video']); ?>" type="video/mp4">
        </video>
      <?php endif; ?>
       
    <?php if ($col3['sombra'])  : ?>
        <div class="flex-grid__shadow" aria-hidden="true"></div>
    <?php endif; ?>

    <?php if ($col3['etiqueta']) : ?>
      <span class="flex-grid__tag"><?php echo esc_html($col3['etiqueta']); ?></span>
    <?php endif; ?>

      <div class="flex-grid__wrap">
        <?php if ($col3['subtitulo']) : ?><small class="flex-grid__subtitle"><?php echo esc_html($col3['subtitulo']); ?></small><?php endif; ?>
        <h2 class="flex-grid__title"><?php echo esc_html($col3['titulo']); ?></h2>
        <p class="flex-grid__description">
          <?php echo esc_html(wp_trim_words($col3['descriptivo'], 8, '...')); ?>
        </p>
        
      </div>

      <?php if ($col3['link']) : ?>
        <a class="flex-grid__link" href="<?php echo esc_url($col3['link']); ?>" aria-label="Leer más sobre <?php echo esc_attr($col3['titulo']); ?>">
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      <?php endif; ?>
    </article>

  </div>

  <!-- :: Columna 4 -->
  <article 
   onclick="location.href='<?php echo esc_url($col4['link']); ?>'"
   class="flex-grid__col col--4" 
   style="background-image: url('<?php echo esc_url($col4['imagen']); ?>');" 
   aria-label="<?php echo esc_attr($col4['titulo']); ?>">
   
    <?php if ($col4['video']) : ?>
      <video autoplay muted loop class="flex-grid__video" aria-hidden="true">
        <source src="<?php echo esc_url($col4['video']); ?>" type="video/mp4">
      </video>
    <?php endif; ?>
   
    <?php if ($col4['sombra'])  : ?>
        <div class="flex-grid__shadow" aria-hidden="true"></div>
    <?php endif; ?>

    <?php if ($col4['etiqueta']) : ?>
      <span class="flex-grid__tag"><?php echo esc_html($col4['etiqueta']); ?></span>
    <?php endif; ?>

    <div class="flex-grid__wrap">
      <?php if ($col4['subtitulo']) : ?><small class="flex-grid__subtitle"><?php echo esc_html($col4['subtitulo']); ?></small><?php endif; ?>
      <h2 class="flex-grid__title"><?php echo esc_html($col4['titulo']); ?></h2>
      
      <p class="flex-grid__description">
       <?php echo esc_html(wp_trim_words($col4['descriptivo'], 8, '...')); ?>
      </p>
    </div>

    <?php if ($col4['link']) : ?>
      <a class="flex-grid__link" href="<?php echo esc_url($col4['link']); ?>" aria-label="Leer más sobre <?php echo esc_attr($col4['titulo']); ?>">
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    <?php endif; ?>
  </article>

</section>
