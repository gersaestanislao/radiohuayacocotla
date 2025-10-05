<footer class="site-footer u-texto">
  <div class="site-footer__container">

    <!-- Columna: Logo de la radio -->
    <div class="site-footer__column">
      <img 
        src="<?php bloginfo('template_url') ?>/images/logo-radio-huaya.png"
        alt="Logo de La Voz Campesina – Radio Huaya"
        class="site-footer__logo" />
    </div>

    <!-- Columna: Información de contacto -->
    <div class="site-footer__column">
      <h6 class="site-footer__title u-texto">Contáctanos</h6>
      <address class="site-footer__contact">
        <!-- Dirección y medios de contacto -->
        Radio Huayacocotla, La Voz Campesina 105.5 FM<br />
        Gutiérrez Nájera 7, Col Centro, 92600 Huayacocotla, Ver.<br /><br />

        <!-- Teléfono en cabina -->
        Teléfono en cabina: 
        <a href="tel:7747580067">774 758 00 67</a><br />

        <!-- WhatsApp con enlace directo -->
        WhatsApp: 
        <a href="https://wa.me/527713557758" target="_blank" rel="noopener noreferrer">
          77-13-55-77-58
        </a>
      </address>
    </div>

    <!-- Columna: Navegación secundaria del sitio -->
    <div class="site-footer__column">
      <h6 class="site-footer__title u-texto">Secciones</h6>
      <ul class="site-footer__links">
        <!-- Enlaces internos del sitio -->
        <li><a href="/noticiero-local">Noticiero Local</a></li>
        <li><a href="/producciones">Producciones</a></li>
        <li><a href="/programacion">Programación</a></li>
        <li><a href="/la-radio">Lo que hacemos</a></li>
        <li><a href="/contacto">Contacto</a></li>
      </ul>
    </div>

    <!-- Columna: Redes sociales -->
    <div class="site-footer__column site-footer__social">
      <p>Síguenos</p>
      <!-- Íconos de redes sociales con accesibilidad mejorada -->
      <a href="https://www.facebook.com/lavozcampesinaFM/" 
         target="_blank" 
         rel="noopener noreferrer" 
         aria-label="Facebook">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://www.instagram.com/fomento_radiohuaya/" 
         target="_blank" 
         rel="noopener noreferrer" 
         aria-label="Instagram">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://twitter.com/radio_huaya?lang=es" 
         target="_blank" 
         rel="noopener noreferrer" 
         aria-label="X (Twitter)">
        <i class="fab fa-x-twitter"></i>
      </a>
      <a href="https://www.youtube.com/channel/UCgTanyYlUa3Ztx-3OrcQyjQ" 
         target="_blank" 
         rel="noopener noreferrer" 
         aria-label="YouTube">
        <i class="fab fa-youtube"></i>
      </a>
      <a href="https://wa.me/7713557758" 
         target="_blank" 
         rel="noopener noreferrer" 
         aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
      </a>
    </div>

  </div>

  <!-- Línea inferior con derechos -->
  <div class="site-footer__legales">
    La Voz Campesina – Radio Huaya © 2025. Todos los derechos reservados.
  </div>
</footer>

<!-- Botones de acción flotantes: WhatsApp y radio en vivo -->
<a href="https://wa.me/7713557758"
   class="btn-floating btn-whatsapp"
   aria-label="Enviar mensaje por WhatsApp"
   rel="noopener noreferrer"
   target="_blank">
  <i class="fab fa-whatsapp" aria-hidden="true"></i>
</a>

<a href="#"
   class="btn-floating btn-radio"
   aria-label="Escuchar radio en vivo">
  <i class="fas fa-broadcast-tower" aria-hidden="true"></i>
</a>

<!-- Inclusión del componente modal -->
<?php include('moduls/m-modal.php'); ?>

<!-- Carga de scripts externos y locales -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer></script>
<script src="<?php bloginfo('template_url') ?>/script.js" defer></script>

<!-- MixItUp Core -->
<script src="https://cdn.jsdelivr.net/npm/mixitup/dist/mixitup.min.js"></script>


<!-- Addon de paginación -->
<script src="https://cdn.jsdelivr.net/npm/mixitup-pagination/dist/mixitup-pagination.min.js"></script>

<script src="<?php bloginfo('template_url') ?>/filter.js" defer></script>

<?php wp_footer(); ?>