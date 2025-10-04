<?php 
// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
include('components/c-header.php'); ?>

<?php
// Obtener el slug actual y el tipo de contenido
    global $wp;
    $current_slug = add_query_arg([], $wp->request);
    $post_type = get_post_type();
?>
    

<main id="content">

    <section class="u-columns w-section w-section--content-inter">
        
    <?php
        // =======================
        // LÓGICA DE CARGA DE PLANTILLAS POR TIPO DE CONTENIDO
        // =======================

            // Programas y cartas comparten plantilla de programación
            if ($post_type === 'noticiero' || $post_type === 'videos') {
            
                include('entries/e-news.php');


            // Programas y cartas comparten plantilla de programación
            } elseif($post_type === 'producciones') {
            
                include('entries/e-produccion.php');
        
            // Por defecto: plantilla genérica de nota
            } else {
                include('entries/e-generic.php');
            }
            ?>
    </section>

    <section 
        class="carrusel-img w-section 
                w-section--bg-grey
                w-section--content-carrusel">


        <!-- Módulo de titulo de sección -->

        <article class="m-title m-title--bg-light">
            <!-- Título principal del módulo -->
            <header>
                <h2 class="m-title__title u-title">
                    Explora más de nuestras producciones
                </h2>

                <!-- Botón de acción -->
                <a href="/producciones" class="m-title__btn btn btn--dark" role="button">
                    Ver todas las producciones
                </a>
            </header>
        </article>

        <div class="owl-carousel owl--news owl--img owl-theme" aria-label="Carrusel de noticias">
     
            <!-- Carga del modúlo de card-->
            <?php include('components/moduls/m-card--img.php'); ?>    
        
        </div>

    </section>

</main>



  <?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('components/c-footer.php'); ?>
