<article class="m-title m-title--bg-dark">
  <!-- Título principal del módulo -->
  <header>
    <?php if ($titulo_del_componente): ?>
      <h2 class="m-title__title u-title">
        <?php echo esc_html($titulo_del_componente); ?>
      </h2>
    <?php endif; ?>
  </header>

  <!-- Descripción del módulo -->
  <!-- <?php if ($descriptivo_del_componente): ?>
    <p class="m-title__descript u-texto">
      <?php echo esc_html($descriptivo_del_componente); ?>
    </p>
  <?php endif; ?> -->

  <!-- Botón de acción -->
  <!-- <?php if ($texto_del_link): ?>
    <a href="<?php echo esc_url($link); ?>" class="m-title__btn btn btn--white" role="button">
      <?php echo esc_html($texto_del_link); ?>
    </a>
  <?php endif; ?> -->
</article>