<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>La voz campesina - Radio Huayacocotla</title>
  
  <?php wp_head(); ?>

  <!-- Tipografías -->
  <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Oswald:wght@200..700&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Space+Grotesk:wght@300..700&family=Staatliches&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Iconografía -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-d0Rvr4fhkL/..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Carrusel (Owl) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <!-- Estilos locales -->
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/styles.css" />
</head>
<body>


<header class="header" role="banner">
  <!-- Navegación principal -->
  <nav class="header__nav" aria-label="Menú principal">
    
    <!-- Logo de la radio, vuelve al inicio -->
    <a href="/" class="header__logo-link">
      <img 
        src="<?php bloginfo('template_url') ?>/images/logo-radio-huaya.png"
        alt="Logo de La Voz Campesina – Radio Huaya"
        class="header__logo" />
    </a>

  <!-- Trigger content  -->
    <div class="header__triggers-content">

   
      <!-- Botón para abrir el modal de busqueda -->
      <button 
        class="header__search-btn modal-buscador"
        id="openModal" 
        type="button"
        aria-expanded="false"
        aria-controls="modalSearch"
        aria-label="Abrir modal de búsqueda">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
      </button>

      <!-- Botón para abrir el menú en dispositivos móviles -->
      <button 
        class="header__menu-btn"
        id="menuToggle"
        aria-expanded="false"
        aria-controls="mobileMenu"
        aria-label="Abrir menú de navegación">
        <i class="fas fa-bars" aria-hidden="true"></i>
      </button>

    </div>

    <!-- Menú de navegación para escritorio -->
    <ul class="header__menu header__menu--desktop">

      <li class="header__menu--desktop-item"><a href="<?php echo site_url() ; ?>">Inicio</a></li>
      <li class="header__menu--desktop-item"><a href="<?php echo site_url() ; ?>/Noticiero">Noticiero</a></li>
      <li class="header__menu--desktop-item"><a href="<?php echo site_url() ; ?>/Producciones">Producciones</a></li>
      <li class="header__menu--desktop-item"><a href="<?php echo site_url() ; ?>/Videos">Videos</a></li>
      <li class="header__menu--desktop-item"><a href="<?php echo site_url() ; ?>/la-radio">La Radio</a></li>
      <li class="header__menu--desktop-item"><a href="<?php echo site_url() ; ?>/contacto">Contacto</a></li>

      <!-- Redes sociales -->
      <li class="header__menu--desktop-item header__menu--desktop-item--redes">
        <ul>
          <li><a target="_blank" href="https://www.instagram.com/fomento_radiohuaya/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a target="_blank" href="https://www.facebook.com/lavozcampesinaFM/" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
          <li><a target="_blank" href="https://twitter.com/radio_huaya?lang=es" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a></li>
          <li><a target="_blank" href="https://www.youtube.com/channel/UCgTanyYlUa3Ztx-3OrcQyjQ" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
          <li><a target="_blank" href="https://wa.me/7713557758" aria-label="Whatsapp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
        </ul>
      </li>

      <li class="header__menu--desktop-item"><a class="btn--main" href="<?php echo site_url() ; ?>/donaciones">Donaciones</a></li>
      
      <!-- Redes buscador -->
      <li class="header__menu--desktop-item header__menu--desktop-item--search">
        <ul>
          <li>
            <!-- Botón para abrir el modal de busqueda -->
            <button 
              class="header__search-btn  header__search-btn--lg modal-buscador"
              id="openModal2" 
              type="button"
              aria-expanded="false"
              aria-controls="modalSearch"
              aria-label="Abrir modal de búsqueda">
              <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
            </button>
          </li>
        </ul>
      </li>


    </ul>
  </nav>

  <!-- Menú de navegación para móvil (se muestra al hacer clic en el botón) -->
  <ul class="header__menu header__menu--mobile" id="mobileMenu" hidden>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/">Inicio</a></li>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/Noticiero">Noticiero</a></li>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/Producciones">Producciones</a></li>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/Videos">Videos</a></li>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/la-radio">La radio</a></li>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/contacto">Contacto</a></li>
    <li><a class="u-texto-lg" href="<?php echo site_url() ; ?>/donaciones">Donaciones</a></li>

    <!-- Subgrupo de redes sociales dentro del menú móvil -->
    <li class="header__menu header__menu--mobile-redes">
      <ul>
          <li><a target="_blank" href="https://www.instagram.com/fomento_radiohuaya/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a target="_blank" href="https://www.facebook.com/lavozcampesinaFM/" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
          <li><a target="_blank" href="https://twitter.com/radio_huaya?lang=es" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a></li>
          <li><a target="_blank" href="https://www.youtube.com/channel/UCgTanyYlUa3Ztx-3OrcQyjQ" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
          <li><a target="_blank" href="https://wa.me/7713557758" aria-label="Whatsapp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
        </ul>
      </ul>
    </li>
  </ul>

<?php 
// =======================
// programacion 
// =======================
include('c-programacion.php'); 

?>



</header>
