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
        <article class="m-title m-title--news m-title--bg-dark">
                <!-- Título principal del módulo -->
                <header>
                    <?php if ($titulo_del_componente): ?>
                    <h2 class="m-title__title u-title">
                        <?php echo esc_html($titulo_del_componente); ?>
                    </h2>
                    <?php endif; ?>
                </header>
            </article>

        <div class="noticiero__grid">

            <!-- Noticia destacada -->
            <div class="noticiero__columnn  noticiero__column--lg">  
                <?php include('moduls/m-card--secondary--home.php'); ?>  
            </div>

            <!-- Noticia secundaria -->
            <div class="noticiero__column noticiero__column--sm">  
                <?php include('moduls/m-card--secondarySm.php'); ?>  
            </div>

            <div class="noticiero__column noticiero__column--xl"> 

              <a href="<?php echo esc_url($link); ?>" class="m-title__btn btn btn--primary" role="button">
                 Ver todas las noticias
              </a>

            </div> 

        </div>

      <!-- Botón de acción -->

 

    </section>
