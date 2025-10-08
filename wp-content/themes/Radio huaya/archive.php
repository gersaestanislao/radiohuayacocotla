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

    <section class="w-section catalog contenedor-cards" >

        <!-- Título  -->
        <article class="catalog__eyetcher">

                <!-- Título principal del módulo -->
                <header>
                    <h2 class="catalog__eyetcherTitle">
                       <?php echo  $post_type; ?>
                    </h2>
                </header>

        </article>

        <div class="contenedor-cards__grid">
        
            <!-- Columna 1: Filtros -->
            <aside class="contenedor-cards__filtros" aria-label="Filtros">
                
                    <div class="filters-accordion">
                
                    <!-- btn -->
                    <button class="accordion-toggle" aria-expanded="false" aria-controls="filters-content" id="filters-toggle">
                        Filtros de categorias
                    </button>

                    <div class="filters-content controls" id="filters-content" hidden>
                        <?php
                        // Cambia 'tu_post_type' por el nombre de tu CPT
                        $terms = get_terms(array(
                            'taxonomy'   => 'category',
                            'hide_empty' => true,
                            'object_ids' => get_posts(array(
                                'post_type'      => $post_type,
                                'posts_per_page' => -1,
                                'fields'         => 'ids',
                            )),
                        ));

                        if (!empty($terms) && !is_wp_error($terms)) : 
                        
                        ?>
                    
                             <fieldset>
                                <legend><strong>Temas</strong></legend>
                                <?php foreach ($terms as $term) : ?>
                                    <label class="checkbox-wrapper">
                                    <input type="checkbox" class="filter-checkbox" value=".<?php echo esc_attr($term->slug); ?>" />
                                    <div class="custom-checkbox">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span><?php echo esc_html($term->name); ?></span>
                                </label>
                                <?php endforeach; ?>
                            </fieldset>


                        <?php endif; ?>

                        <button type="button"  id="reset-filters" class="btn btn--dark u-w100">Limpiar filtros</button>

                    </div>
                </div>
            </aside>


            <aside class="contenedor-cards__filtros--movil" aria-label="Filtros">
                <div class="controls-filters">

                <?php
                    // Cambia 'tu_post_type' por el nombre de tu CPT
                    $terms = get_terms(array(
                        'taxonomy'   => 'category',
                        'hide_empty' => true,
                        'object_ids' => get_posts(array(
                            'post_type'      => $post_type,
                            'posts_per_page' => -1,
                            'fields'         => 'ids',
                        )),
                    ));

                    if (!empty($terms) && !is_wp_error($terms)) : 
                    
                    ?>
                    <button type="button" class="filter" data-filter="all">Todas</button>
                    
                    <?php foreach ($terms as $term) : ?>
                        <button type="button" class="filter" data-filter=".<?php echo esc_attr($term->slug); ?>">
                            <?php echo esc_html($term->name); ?>
                        </button>
                    <?php endforeach; ?>

                    <?php endif; ?>

                </div>
            </aside>

            <!-- Contenido  -->

            <article>


            <?php
                // Definir configuración según el tipo de post
                switch ($post_type) {
                    case 'videos':
                        $containerClass = 'contenedor-cards__lista--twocolumns';
                        $cardTemplate   = 'components/moduls/m-card--video.php';
                        break;

                    case 'noticiero':
                        $containerClass = 'contenedor-cards__lista';
                        $cardTemplate   = 'components/moduls/m-card--secondary.php';
                        break;

                    default:
                        $containerClass = 'contenedor-cards__lista--twocolumns';
                        $cardTemplate   = 'components/moduls/m-card--img.php';
                        break;
                }
                ?>

                <!-- Contenedor dinámico -->
                <div class="<?= esc_attr($containerClass); ?>" id="mix-container">
                    <!-- Carga del módulo de tarjeta correspondiente -->
                    <?php include locate_template($cardTemplate); ?> 
                </div>





                <div class="controls">
                    <div class="mixitup-page-list"></div>
                </div>
            
            </article>

         <!-- Controles de paginación -->


        </div>
    </section>



</main>



  <?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('components/c-footer.php'); ?>
