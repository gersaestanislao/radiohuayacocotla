<?php
/**
 * Template Name: La Radio generíca
 */

include 'components/c-header.php';
?>
<main id="main" class="radio-page">

<!-- ===== Hero Section ===== -->
<section 
  class="radio-hero" 
  style="--radio-hero-bg: url('http://localhost:8888/huayaWP/wp-content/uploads/2025/09/Chicomezochitl.jpeg');">
  <div class="radio-hero__overlay" aria-hidden="true"></div>
  <div class="radio-hero__content">
    <h1 class="radio-hero__title">La Radio Huaya</h1>
  </div>
</section>

<div class="radio-page__body">

  <!-- ===== Section: Quiénes somos ===== -->
  <section class="radio-section">
    <div class="radio-section__media">
      <img 
        class="radio-section__image" 
        src="http://localhost:8888/huayaWP/wp-content/themes/Radio%20huaya/images/image-2.png" 
        alt="Personas reunidas en una asamblea comunitaria" 
        loading="lazy"
      >
    </div>
    <div class="radio-section__content">
      <span class="radio-section__eyebrow">Quiénes somos</span>
      <h2 class="radio-section__title">Una radio que crece con su comunidad</h2>
      <div class="radio-section__description">
        <p>
          Radio Huaya surge del trabajo colaborativo entre colectivos, autoridades comunitarias 
          y voluntades que creen en la comunicación popular. Cada programa se construye 
          escuchando a la gente para acompañar los procesos sociales y culturales de la región.
        </p>
      </div>
    </div>
  </section>

  <!-- ===== Section: Historia viva ===== -->
  <section class="radio-section radio-section--image-right">
    <div class="radio-section__media">
      <img 
        class="radio-section__image" 
        src="http://localhost:8888/huayaWP/wp-content/themes/Radio%20huaya/images/image-3.png" 
        alt="Celebración comunitaria en el cerro" 
        loading="lazy"
      >
    </div>
    <div class="radio-section__content">
      <span class="radio-section__eyebrow">Historia viva</span>
      <h2 class="radio-section__title">Celebramos las raíces y las voces locales</h2>
      <div class="radio-section__description">
        <p>
          Transmitimos en lenguas originarias y en español para mantener viva la memoria colectiva. 
          Nuestros micrófonos amplifican la música, las fiestas y las historias que dan identidad a los pueblos.
        </p>
      </div>
    </div>
  </section>

  <!-- ===== Section: Participación ===== -->
  <section class="radio-section">
    <div class="radio-section__media">
      <img 
        class="radio-section__image" 
        src="http://localhost:8888/huayaWP/wp-content/themes/Radio%20huaya/images/image-4.png" 
        alt="Personas participando en un taller al aire libre" 
        loading="lazy"
      >
    </div>
    <div class="radio-section__content">
      <span class="radio-section__eyebrow">Participación</span>
      <h2 class="radio-section__title">Espacios abiertos para todas las edades</h2>
      <div class="radio-section__description">
        <p>
          Talleres, transmisiones especiales y brigadas itinerantes acercan la radio a niñas, 
          niños, jóvenes y personas mayores. Creemos en aprender haciendo y en compartir el 
          conocimiento de manera horizontal.
        </p>
      </div>
    </div>
  </section>

  <!-- ===== Section: Futuro ===== -->
  <section class="radio-section radio-section--image-right">
    <div class="radio-section__media">
      <img 
        class="radio-section__image" 
        src="http://localhost:8888/huayaWP/wp-content/themes/Radio%20huaya/images/image-6.png" 
        alt="Cabina de radio con micrófonos y consola" 
        loading="lazy"
      >
    </div>
    <div class="radio-section__content">
      <span class="radio-section__eyebrow">Futuro</span>
      <h2 class="radio-section__title">Innovamos sin perder el sentido comunitario</h2>
      <div class="radio-section__description">
        <p>
          Exploramos nuevas plataformas digitales para que la señal comunitaria llegue más lejos. 
          La tecnología es una aliada cuando se usa para fortalecer la organización y el tejido social.
        </p>
      </div>
    </div>
  </section>

  <!-- ===== Section: Nuestros pilares ===== -->
  <section class="radio-values" aria-labelledby="radio-values-title">
    <header class="radio-values__header">
      <h2 id="radio-values-title" class="radio-values__title">Nuestros pilares</h2>
    </header>

    <div class="radio-values__grid">
      <article class="radio-values__item">
        <h3 class="radio-values__item-title">Comunidad</h3>
        <p class="radio-values__item-text">
          Somos un espacio tejido por asambleas, comités y voluntariado. 
          Cada voz cuenta y se integra a la programación.
        </p>
      </article>

      <article class="radio-values__item">
        <h3 class="radio-values__item-title">Identidad</h3>
        <p class="radio-values__item-text">
          Promovemos lenguas originarias, la música tradicional y los conocimientos 
          que fortalecen la memoria colectiva.
        </p>
      </article>

      <article class="radio-values__item">
        <h3 class="radio-values__item-title">Participación</h3>
        <p class="radio-values__item-text">
          Abrimos la cabina para que niñas, niños, jóvenes y personas adultas mayores 
          produzcan contenidos y compartan sus historias.
        </p>
      </article>
    </div>
  </section>



  <!-- TABS  -->
  <section class="tabs" >

    <div class="tabs__content">
          <button id="tab1" role="tab" class="tabs__tab" aria-selected="true" aria-controls="panel1" tabindex="0">
            <p class="u-text">Lunes</p>
            <small class="u-tool">L</small>
          </button>
          <button id="tab2" role="tab" class="tabs__tab" aria-selected="false" aria-controls="panel2" tabindex="-1">
            <p class="u-text">Martes</p>
            <small class="u-tool">M</small>
          </button>
    </div>


    <div id="panel1" class="tabs__panel" role="tabpanel" aria-labelledby="tab1">
      <h2>title</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, ipsam cupiditate. Similique voluptatibus atque nam velit, enim odio itaque, minus numquam voluptatum natus dolores perspiciatis quidem aut harum? Magni, suscipit.</p>
      </div>


        <div id="panel2" class="tabs__panel" role="tabpanel" aria-labelledby="tab2" hidden="hidden">
          hola 2
      </div>

    </section>


    <!-- Acordeon  -->
    <section class="accordion" aria-label="Sección de contenido expandible">
  <!-- Item 1 -->
  <div class="accordion__item">
    <h2 class="accordion__header">
      <button 
        class="accordion__trigger" 
        aria-expanded="true" 
        aria-controls="accordion-panel-1" 
        id="accordion-trigger-1"
      >
        <span class="accordion__title">Item 1</span>
        <span class="accordion__icon" aria-hidden="true"></span>
      </button>
    </h2>
    <div 
      id="accordion-panel-1" 
      class="accordion__panel" 
      role="region" 
      aria-labelledby="accordion-trigger-1"
    >
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quos corporis consectetur eum provident obcaecati illo tempore...
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quos corporis consectetur eum provident obcaecati illo 
        <a href="#">este es un link</a> rem optio facilis suscipit vel.
      </p>

      <h3>Subtitulo</h3>
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quos corporis consectetur eum provident obcaecati illo tempore...
      </p>

      <h3>Título</h3>
      <ul>
        <li>Uno</li>
        <li>Dos</li>
        <li>Tres</li>
      </ul>
    </div>
  </div>

  <!-- Item 2 -->
  <div class="accordion__item">
    <h2 class="accordion__header">
      <button 
        class="accordion__trigger" 
        aria-expanded="false" 
        aria-controls="accordion-panel-2" 
        id="accordion-trigger-2"
      >
        <span class="accordion__title">Item 2</span>
        <span class="accordion__icon" aria-hidden="true"></span>
      </button>
    </h2>
    <div 
      id="accordion-panel-2" 
      class="accordion__panel" 
      role="region" 
      aria-labelledby="accordion-trigger-2"
      hidden
    >
      <p>Contenido del segundo ítem.</p>
    </div>
  </div>

  <!-- Item 3 -->
  <div class="accordion__item">
    <h2 class="accordion__header">
      <button 
        class="accordion__trigger" 
        aria-expanded="false" 
        aria-controls="accordion-panel-3" 
        id="accordion-trigger-3"
      >
        <span class="accordion__title">Item 3</span>
        <span class="accordion__icon" aria-hidden="true"></span>
      </button>
    </h2>
    <div 
      id="accordion-panel-3" 
      class="accordion__panel" 
      role="region" 
      aria-labelledby="accordion-trigger-3"
      hidden
    >
      <p>Contenido del tercer ítem.</p>
    </div>
  </div>
</section>




</div> <!-- /.radio-page__body -->
</main>


<?php include 'components/c-footer.php';
?>
