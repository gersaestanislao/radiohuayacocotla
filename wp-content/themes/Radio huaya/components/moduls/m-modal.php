<!-- Contenedor del modal (oculto por defecto con `hidden`) -->
<section
  class="modal"
  id="myModal"
  role="dialog"
  aria-modal="true"
  aria-labelledby="modalTitle"
  aria-hidden="true"
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

    <form
      class="modal__form"
      role="search"
      method="get"
      action="<?php echo esc_url( home_url( '/' ) ); ?>"
    >
      <label class="u-sr-only" for="modalSearchInput">Buscar contenidos en Radio Huaya</label>
      <input
        class="modal__input"
        type="search"
        id="modalSearchInput"
        name="s"
        placeholder="Escribe una palabra clave"
        value="<?php echo esc_attr( get_search_query() ); ?>"
        required
      />
      <button class="modal__submit btn btn--black" type="submit">
        Buscar
      </button>
    </form>
  </div>
</section>

