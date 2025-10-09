<?php
/**
 * Template Name: Plantilla dinámica
 *
 * Este archivo define una plantilla de página en WordPress que carga componentes
 * dinámicamente según la estructura flexible de campos definidos con ACF (Advanced Custom Fields).
 */

// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
?>


<?php 
// =======================
// CABECERA GLOBAL DEL SITIO
// =======================
include('components/c-header.php'); ?>

<?php
// ============================
// INICIO DEL LOOP DE LAYOUT FLEXIBLE
// ============================
if (have_rows('layout')) :
    while (have_rows('layout')) : the_row();

        // ===================
        // CARRUSEL PRINCIPAL (HERO)
        // ===================
        if (get_row_layout() === 'carrusel') :
            get_template_part('components/c', 'carrusel--hero');

        // ===================
        // GRID DE DESTACADOS
        // ===================
        elseif (get_row_layout() === 'destacados') :
            get_template_part('components/c', 'grid-destacados');

        // ===================
        // CARRUSEL DE IMÁGENES
        // ===================
        elseif (get_row_layout() === 'carrusel-images') :
            get_template_part('components/c', 'carrusel--img');

        // ===================
        // CARRUSEL MULTIMEDIA (AUDIOS, VIDEOS, ETC.)
        // ===================
        elseif (get_row_layout() === 'carrusel-multimedia') :
            get_template_part('components/c', 'noticias');

        // ===================
        // PROGRAMACIÓN EN PESTAÑAS
        // ===================
        elseif (get_row_layout() === 'programacion') :
            get_template_part('components/c', 'tabs');

        // ===================
        // CARRUSEL DE VIDEOS
        // ===================
        elseif (get_row_layout() === 'carrusel-video') :
            get_template_part('components/c', 'carrusel--video');

        endif;

    endwhile;
endif;
// ============================
// FIN DEL LOOP DE LAYOUT
// ============================
?>

<?php 
// =======================
// FOOTER GLOBAL DEL SITIO
// =======================

include('components/c-footer.php'); ?>
