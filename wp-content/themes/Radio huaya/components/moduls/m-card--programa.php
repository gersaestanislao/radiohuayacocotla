<article class="program-card"
    role="group"
    aria-label="<?php echo esc_attr($descriptivo); ?>"
    data-hora-inicio="<?php echo esc_attr($inicio); ?>"
    data-hora-fin="<?php echo esc_attr($fin); ?>"
>
  <!-- Etiqueta de categoría -->
  <div class="program-card__tag program-card__tag--<?php echo esc_attr($genero); ?>" aria-hidden="true">
    <?php echo esc_html($text_genero); ?>
  </div>

  <!-- Información del programa -->
  <div class="program-card__info">
    <!-- Horario -->
    <span class="program-card__time"><?php echo esc_html($inicio); ?>  - <?php echo esc_html($fin); ?></span>

    <!-- Título del programa -->
    <h3 class="program-card__title">
      <?php echo esc_html($titulo); ?>
    </h3>



  </div>
</article>