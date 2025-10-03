<!-- Contenedor del modal (oculto por defecto con `hidden`) -->
<section
  class="modal"
  id="myModal"
  role="dialog"
  aria-modal="true"
  aria-labelledby="modalTitle"
  hidden
>
  <!-- Fondo oscuro clicable para cerrar el modal -->
  <div class="modal__overlay" id="modalOverlay" tabindex="-1" aria-hidden="true"></div>

  <!-- Contenido principal del modal -->
  <div class="modal__content" role="document">
    
    <!-- Botón de cierre (ícono "X") -->
    <button
      class="modal__close btn-close"
      id="closeModal"
      type="button"
      aria-label="Cerrar modal"
    >
      <i class="fa-solid fa-times" aria-hidden="true"></i>
    </button>

    <!-- Título accesible del modal -->
    <h2 class="modal__title u-title" id="modalTitle">Busca y escucha la palabra de nuestra gente</h2>

    <!-- Cuerpo de texto del modal -->
    <p class="modal__text">
    Explora los contenidos de nuestra radio comunitaria: noticias, programas, podcasts y series que recogen las voces, memorias y saberes de los pueblos originarios.
    </p>
    <input type="text" placeholder="Escribe una palabra clave">


    <!-- Botón de acción dentro del modal -->
    <button class="btn btn--black" type="button">
      Buscar
    </button>
  </div>
</section>

