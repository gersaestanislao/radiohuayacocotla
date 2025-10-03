<?php 
  // ========================
  // VARIABLES DEL BLOQUE
  // ========================

  // Texto descriptivo general del módulo (campo opcional)
  $descripcion_modulo = get_sub_field('decriptivo_del_modulo'); // Ojo: en ACF está mal escrito como "decriptivo"

  // Clase de visibilidad para controlar si se muestra u oculta el bloque
  $visibilidad = get_sub_field('visibilidad');



// 1. Obtener el día actual con acento y capitalizado (ej. "Lunes", "Martes", etc.)
$formatter = new \IntlDateFormatter(
  'es_ES',
  \IntlDateFormatter::FULL,
  \IntlDateFormatter::NONE,
  'America/Mexico_City',
  \IntlDateFormatter::GREGORIAN,
  'EEEE' // día de la semana completo
);

$diaConAcento = ucfirst($formatter->format(new \DateTime())); 
  
// 2. Consultar los posts de programación
$programas = get_posts([
      'post_type'      => 'programacion',
      'posts_per_page' => -1,
  ]);

?>

<!-- Carrusel de programación de radio -->
<section 
  class="programacion-carousel <?php echo esc_attr($visibilidad); ?>" 
  aria-label="<?php echo esc_html($descripcion_modulo); ?>"
>

  <!-- Título del módulo -->
  <div class="programacion-carousel__titulo-modulo">
    <small>Programación </small>

    <h3><?php echo esc_attr($diaConAcento); ?>:</h3>
  </div>

  <!-- Contenedor del carrusel -->
  <div class="programacion-carousel__content">
    <div class="programacion-carousel__modul owl-carousel" aria-label="<?php echo esc_html($descripcion_modulo); ?>">

     
    <!-- Programas -->
    <?php if ($programas) : ?>
    <?php foreach ($programas as $programa) : ?>
      <?php
        $post_id = $programa->ID;
        $diaPost = get_the_title($post_id); // Título del post = día
      ?>
        <!-- Carga de programa -->
        <?php include('moduls/m-card-programa-sm.php'); ?>
        <?php
          endforeach;
          wp_reset_postdata();
        ?>
      <?php endif; ?>



    </div> <!-- .owl-carousel -->
  </div> <!-- .programacion-carousel__content -->

  <!-- Botón para escuchar en vivo -->
  <div class="programacion-carousel__escucha-vivo">
    <a 
      href="#" 
      class="programacion-carousel__boton-vivo" 
      aria-label="Escuchar transmisión en vivo"
    >
      <span class="programacion-carousel__icono-play" aria-hidden="true"></span>
      <i class="fa-solid fa-circle-play" aria-hidden="true"></i>
      Escúchanos en vivo
    </a>
  </div>

</section>