document.addEventListener('DOMContentLoaded', () => {

  // ========================
  // 1. Menú móvil accesible
  // ========================
  const toggleBtn = document.getElementById('menuToggle');
  const mobileMenu = document.getElementById('mobileMenu');
  const icon = toggleBtn?.querySelector('i');
  const focusableSelectors = 'a, button, textarea, input, select, [tabindex]:not([tabindex="-1"])';
  let previousFocus = null;

  // Inicialización del menú
  if (toggleBtn && mobileMenu) {
    mobileMenu.hidden = true;
    toggleBtn.setAttribute('aria-expanded', 'false');
    mobileMenu.classList.remove('menu--visible');

    function openMenu() {
      previousFocus = document.activeElement;
      mobileMenu.hidden = false;
      mobileMenu.classList.add('menu--visible');
      toggleBtn.classList.add('header__menu-btn--open')
      toggleBtn.setAttribute('aria-expanded', 'true');
      icon?.classList.replace('fa-bars', 'fa-times');

      const firstLink = mobileMenu.querySelector(focusableSelectors);
      firstLink?.focus();

      document.addEventListener('keydown', trapFocus);
    }

    function closeMenu() {
      mobileMenu.hidden = true;
      mobileMenu.classList.remove('menu--visible');
      toggleBtn.setAttribute('aria-expanded', 'false');
      toggleBtn.classList.remove('header__menu-btn--open')
      icon?.classList.replace('fa-times', 'fa-bars');
      previousFocus?.focus();

      document.removeEventListener('keydown', trapFocus);
    }

    function trapFocus(e) {
      if (e.key !== 'Tab') return;

      const focusables = Array.from(mobileMenu.querySelectorAll(focusableSelectors));
      const first = focusables[0];
      const last = focusables[focusables.length - 1];

      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault();
        last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }

    toggleBtn.addEventListener('click', (e) => {
      const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
      isExpanded ? closeMenu() : openMenu();
      e.stopPropagation();
    });

    document.addEventListener('click', (e) => {
      const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
      const clickedOutside = !mobileMenu.contains(e.target) && !toggleBtn.contains(e.target);
      if (isExpanded && clickedOutside) closeMenu();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && toggleBtn.getAttribute('aria-expanded') === 'true') {
        closeMenu();
      }
    });
  }

  // ========================
  // 2. Scroll en header
  // ========================
  const header = document.querySelector('.header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('header--scrolled', window.scrollY > 0);
    });
  }

  // ========================
  // 3. Carrusel con OwlCarousel
  // ========================
  if (typeof $ !== 'undefined' && $('.owl-carousel').length) {

  // Carrusel Hero
    $('.owl--hero').owlCarousel({
      loop: true,
      nav: false,
      items: 1,
      autoplay: true,
      autoplayTimeout: 7000,
      autoplaySpeed: 1000,
      responsive: {
        1080: { 
          nav: true,
          dots: false,
          autoplaySpeed: 2000,
        },
      }

    });

    // News
    $('.owl--new').owlCarousel({
      items: 1,
      margin: 10,
      nav: true,
      dots: false,
      center: true,
      autoplay: false,
      autoplayTimeout: 8000,
      autoplaySpeed: 1000,
      responsive: {
        0: {
          items: 2,
          loop: false,
          autoWidth: true,

         },
        768: { 
          margin: 28,
          center: false,
          items: 3,
          autoWidth: true,
          loop: true,
        }
      }
    });

    // Inicializar carrusel y guardar en variable
    var $owlImg = $('.owl--img').owlCarousel({
      items: 1,
      margin: 6,
      nav: false,   // desactivamos las flechas por defecto
      dots: false,
      center: true,
      autoplay: false,
      autoplayTimeout: 8000,
      autoplaySpeed: 1000,
      responsive: {
        0: {
          items: 2,
          loop: false,
          autoWidth: true,
        },
        768: { 
          margin: 18,
          center: false,
          items: 3,
          autoWidth: true,
          loop: true,
        }
      }
    });

    // Botones personalizados
    $('.carrusel-img__controls--prev').on('click', function() {
      $owlImg.trigger('prev.owl.carousel', [300]); // 300 = velocidad
    });

    $('.carrusel-img__controls--next').on('click', function() {
      $owlImg.trigger('next.owl.carousel', [300]);
    });
    


      // Inicializar carrusel y guardar en variable
      var $owlSerie = $('.owl--serie').owlCarousel({
        items: 1,
        margin: 18,
        nav: false,   // desactivamos las flechas por defecto
        dots: false,
        center: true,
        autoplay: false,
        autoplayTimeout: 8000,
        autoplaySpeed: 1000,
        responsive: {
          0: {
            items: 2,
            loop: false,
            autoWidth: true,
          },
          768: { 
            margin: 18,
            center: false,
            items: 3,
            autoWidth: true,
            loop: true,
          }
        }
      });
  
      // Botones personalizados
      $('.carrusel-videos__controls--prevVideos').on('click', function() {
        $owlSerie.trigger('prev.owl.carousel', [300]); // 300 = velocidad
      });
  
      $('.carrusel-videos__controls--nextVideos').on('click', function() {
        $owlSerie.trigger('next.owl.carousel', [300]);
      });

        
  // Cuando un tab se activa
  $('.tabs__tab').on('click', function() {
    var target = $(this).attr('aria-controls'); // ejemplo: panel2
    var $carousel = $('#' + target).find('.owl-carousel');

    // Refrescar el carrusel después de un pequeño delay
    setTimeout(function() {
      $carousel.trigger('refresh.owl.carousel');
    }, 50);
  });
  
  // promgram
  $('.owl--program').owlCarousel({
    items: 2,
    margin: 9,
    nav: true,
    dots: false,
    center: false,
    autoplay: true,
    autoplayTimeout: 8000,
    autoplaySpeed: 1000,
    responsive: {
      0: {
        items: 2,
        loop: false,
        autoWidth: true,
        nav: true,
        },
      768: { 
        margin: 22,
        center: false,
        items: 3,
        autoWidth: false,
        loop: true,
        nav: true,
      },
      992: {
        items: 4,
        loop: true,
        nav: true,

      },
      1420: { 
        loop: true,
        items: 6,
        nav: true,
      }
    }
  });

  }
});





$(function () {
  const $modal = $('#myModal');
  const $modalTriggers = $('.modal-buscador');
  const focusableElementsSelector = 'a, button, textarea, input, select, [tabindex]:not([tabindex="-1"])';
  let previousFocus = null;

  if (!$modal.length) return;

  function trapFocus(e) {
    if (e.key !== 'Tab') return;

    const $focusables = $modal.find(focusableElementsSelector);
    const first = $focusables.get(0);
    const last = $focusables.get($focusables.length - 1);

    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last?.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first?.focus();
    }
  }

  function openModal(event) {
    if (!$modal.is('[hidden]')) return;

    event?.preventDefault();
    previousFocus = document.activeElement;

    $modalTriggers.attr('aria-expanded', 'true');
    $('body').addClass('modal-open');

    $modal.removeAttr('hidden').attr('aria-hidden', 'false');
    $modal.find(focusableElementsSelector).first().focus();

    $(document).on('keydown', trapFocus);
  }

  function closeModal() {
    if ($modal.is('[hidden]')) return;

    $modal.attr('hidden', true).attr('aria-hidden', 'true');
    $modalTriggers.attr('aria-expanded', 'false');
    $('body').removeClass('modal-open');

    previousFocus?.focus();
    previousFocus = null;

    $(document).off('keydown', trapFocus);
  }

  $modalTriggers.on('click', openModal);
  $('#closeModal, #modalOverlay').on('click', closeModal);
  $(document).on('keydown', (e) => {
    if (e.key === 'Escape' && !$modal.is('[hidden]')) {
      e.preventDefault();
      closeModal();
    }
  });
});


$(document).ready(function () {
  const $tabs = $('.tabs__tab');

  $tabs.on('click keydown', function (e) {
    const key = e.key;
    const $current = $(this);
    let index = $tabs.index($current);

    // Flechas izquierda y derecha
    if (key === 'ArrowRight') {
      index = (index + 1) % $tabs.length;
      $tabs.eq(index).focus().click();
      return;
    }
    if (key === 'ArrowLeft') {
      index = (index - 1 + $tabs.length) % $tabs.length;
      $tabs.eq(index).focus().click();
      return;
    }

    // Click o Enter o Espacio
    if (e.type === 'click' || key === 'Enter' || key === ' ') {
      $tabs.attr({
        'aria-selected': 'false',
        tabindex: '-1',
      });

      $('.tabs__panel').attr('hidden', true);

      $current.attr({
        'aria-selected': 'true',
        tabindex: '0',
      });

      $('#' + $current.attr('aria-controls')).removeAttr('hidden');
    }
  });

  ///carrusel de programación

    const ahora = new Date();
    const horaActual = ahora.getHours() + ahora.getMinutes() / 60;
    let indexSlideActivo = 0;


    // Recorre cada slide con la clase .programacion-carousel__item
    $('.programacion-carousel__item').each(function (index) {
      const $slide = $(this);
      const horaInicio = $slide.data('hora-inicio'); // formato "14:30"
      const horaFin = $slide.data('hora-fin');       // formato "15:30"

      if (!horaInicio || !horaFin) return;

      const [hInicio, mInicio] = horaInicio.split(':').map(Number);
      const [hFin, mFin] = horaFin.split(':').map(Number);

      const horaIniDecimal = hInicio + mInicio / 60;
      const horaFinDecimal = hFin + mFin / 60;

      if (horaActual >= horaIniDecimal && horaActual < horaFinDecimal) {
        indexSlideActivo = index;
      }

    });

    // Agrega la clase al slide activo
    $('.programacion-carousel__item .programacion-carousel__envivo').eq(indexSlideActivo).addClass('programacion-carousel__estado--en-vivo');


    // Inicializa OwlCarousel y posiciona el slide activo
    $('.programacion-carousel__modul').owlCarousel({
        loop: true,
        autoplay: true,
        autoWidth: true,
        margin: 10,
        nav: true,
        dots: false,
        startPosition: indexSlideActivo,

    });
  });


  const toggleBtn = document.getElementById('filters-toggle');
  const filtersContent = document.getElementById('filters-content');

  toggleBtn?.addEventListener('click', () => {
    const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
    toggleBtn.setAttribute('aria-expanded', String(!expanded));
    filtersContent.hidden = expanded;
  });

  // Mostrar siempre en desktop
  const mediaQuery = window.matchMedia('(min-width: 768px)');
  const handleResize = () => {
    if (mediaQuery.matches) {
      filtersContent.hidden = false;
      toggleBtn.setAttribute('aria-expanded', 'true');
    } else {
      filtersContent.hidden = true;
      toggleBtn.setAttribute('aria-expanded', 'false');
    }
  };
  mediaQuery.addEventListener('change', handleResize);
  handleResize(); // inicializa

