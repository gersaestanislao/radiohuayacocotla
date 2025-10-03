<?php
  // =====================
  // VARIABLES DEL BLOQUE
  // =====================

  // Campo opcional para usar un texto descriptivo general del módulo
  $descriptivo_del_modulo = get_sub_field('descriptivo_del_modulo');
  $visibilidad = get_sub_field('visibilidad');
  $tipo_layout = get_sub_field('tipo_layout');
// === Obtener subcampos de columnas usando ACF ===
  $titulo_del_componente = get_sub_field('titulo_del_componente');
  $descriptivo_del_componente = get_sub_field('descriptivo_del_componente');
  $link = get_sub_field('link');
  $texto_del_link = get_sub_field('texto_del_link');
?>
 

<!-- Carrusel de noticias accesible utilizando Owl Carousel -->
    <section 
      class="carrusel-cards w-section 
             w-section--bg-<?php echo esc_html($tipo_layout); ?> 
             w-section--content-carrusel
             <?php echo esc_html($visibilidad); ?>"
      aria-label="<?php echo esc_html($descriptivo_del_modulo); ?>">
    

      <!-- Módulo de titulo de sección -->
      <?php if ($tipo_layout == 'dark'): ?>
        <?php include('moduls/m-title--dark.php'); ?>
        <?php else: ?>
         <?php include('moduls/m-title.php'); ?> 
      <?php endif; ?>

      <div class="owl-carousel owl--multimedia owl--new owl-theme" aria-label="Carrusel de noticias">
        <!-- Carga del modúlo de card-->
        <?php include('moduls/m-card--secondary.php'); ?>    
      </div> 

    </section>