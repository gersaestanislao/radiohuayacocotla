<?php
/**
 * Template Name: La Radio
 */

include 'components/c-header.php';
?>

<main id="main" class="radio-page">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();
      $theme_uri = get_template_directory_uri();
      $hero_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : $theme_uri . '/images/image-1.png';
      $hero_label = function_exists('get_field') ? get_field('radio_hero_label') : '';
      $hero_description = function_exists('get_field') ? get_field('radio_hero_description') : '';
      $sections_raw = function_exists('get_field') ? get_field('radio_sections') : [];
      $values_title = function_exists('get_field') ? get_field('radio_values_title') : '';
      $values_description = function_exists('get_field') ? get_field('radio_values_description') : '';
      $values_raw = function_exists('get_field') ? get_field('radio_values_items') : [];

      $default_sections = [
        [
          'eyebrow' => __('Quiénes somos', 'radio-huaya'),
          'title' => __('Una radio que crece con su comunidad', 'radio-huaya'),
          'description' => __(
            'Radio Huaya surge del trabajo colaborativo entre colectivos, autoridades comunitarias y voluntades que creen en la comunicación popular. '
            . 'Cada programa se construye escuchando a la gente para acompañar los procesos sociales y culturales de la región.',
            'radio-huaya'
          ),
          'image_url' => $theme_uri . '/images/image-2.png',
          'image_alt' => __('Personas reunidas en una asamblea comunitaria', 'radio-huaya'),
          'alignment' => 'left',
        ],
        [
          'eyebrow' => __('Historia viva', 'radio-huaya'),
          'title' => __('Celebramos las raíces y las voces locales', 'radio-huaya'),
          'description' => __(
            'Transmitimos en lenguas originarias y en español para mantener viva la memoria colectiva. '
            . 'Nuestros micrófonos amplifican la música, las fiestas y las historias que dan identidad a los pueblos.',
            'radio-huaya'
          ),
          'image_url' => $theme_uri . '/images/image-3.png',
          'image_alt' => __('Celebración comunitaria en el cerro', 'radio-huaya'),
          'alignment' => 'right',
        ],
        [
          'eyebrow' => __('Participación', 'radio-huaya'),
          'title' => __('Espacios abiertos para todas las edades', 'radio-huaya'),
          'description' => __(
            'Talleres, transmisiones especiales y brigadas itinerantes acercan la radio a niñas, niños, jóvenes y personas mayores. '
            . 'Creemos en aprender haciendo y en compartir el conocimiento de manera horizontal.',
            'radio-huaya'
          ),
          'image_url' => $theme_uri . '/images/image-4.png',
          'image_alt' => __('Personas participando en un taller al aire libre', 'radio-huaya'),
          'alignment' => 'left',
        ],
        [
          'eyebrow' => __('Futuro', 'radio-huaya'),
          'title' => __('Innovamos sin perder el sentido comunitario', 'radio-huaya'),
          'description' => __(
            'Exploramos nuevas plataformas digitales para que la señal comunitaria llegue más lejos. '
            . 'La tecnología es una aliada cuando se usa para fortalecer la organización y el tejido social.',
            'radio-huaya'
          ),
          'image_url' => $theme_uri . '/images/image-6.png',
          'image_alt' => __('Cabina de radio con micrófonos y consola', 'radio-huaya'),
          'alignment' => 'right',
        ],
      ];

      $sections = [];

      if (is_array($sections_raw) && !empty($sections_raw)) {
        foreach ($sections_raw as $section) {
          if (!is_array($section)) {
            continue;
          }

          $alignment = $section['image_position'] ?? $section['alignment'] ?? 'left';
          $alignment = in_array($alignment, ['left', 'right'], true) ? $alignment : 'left';

          $image_data = $section['image'] ?? null;
          $image_url = '';
          $image_alt = '';

          if (is_array($image_data)) {
            if (!empty($image_data['ID'])) {
              $image_url = wp_get_attachment_image_url($image_data['ID'], 'large');
              $image_alt = get_post_meta($image_data['ID'], '_wp_attachment_image_alt', true) ?: ($section['title'] ?? '');
            } elseif (!empty($image_data['url'])) {
              $image_url = $image_data['url'];
              $image_alt = $image_data['alt'] ?? ($section['title'] ?? '');
            }
          } elseif (is_numeric($image_data)) {
            $image_url = wp_get_attachment_image_url((int) $image_data, 'large');
            $image_alt = get_post_meta((int) $image_data, '_wp_attachment_image_alt', true) ?: ($section['title'] ?? '');
          } elseif (is_string($image_data)) {
            $image_url = $image_data;
          }

          if (!$image_url) {
            $image_url = $theme_uri . '/images/image-2.png';
          }

          if (!$image_alt) {
            $image_alt = $section['title'] ?? __('Imagen descriptiva de la radio comunitaria', 'radio-huaya');
          }

          $sections[] = [
            'eyebrow' => $section['eyebrow'] ?? $section['label'] ?? '',
            'title' => $section['title'] ?? '',
            'description' => $section['description'] ?? $section['text'] ?? '',
            'image_url' => $image_url,
            'image_alt' => $image_alt,
            'alignment' => $alignment,
          ];
        }
      }

      if (empty($sections)) {
        $sections = $default_sections;
      }

      $default_values = [
        [
          'title' => __('Comunidad', 'radio-huaya'),
          'text' => __(
            'Somos un espacio tejido por asambleas, comités y voluntariado. Cada voz cuenta y se integra a la programación.',
            'radio-huaya'
          ),
        ],
        [
          'title' => __('Identidad', 'radio-huaya'),
          'text' => __(
            'Promovemos lenguas originarias, la música tradicional y los conocimientos que fortalecen la memoria colectiva.',
            'radio-huaya'
          ),
        ],
        [
          'title' => __('Participación', 'radio-huaya'),
          'text' => __(
            'Abrimos la cabina para que niñas, niños, jóvenes y personas adultas mayores produzcan contenidos y compartan sus historias.',
            'radio-huaya'
          ),
        ],
      ];

      $values = [];

      if (is_array($values_raw) && !empty($values_raw)) {
        foreach ($values_raw as $value) {
          if (!is_array($value)) {
            continue;
          }

          $values[] = [
            'title' => $value['title'] ?? '',
            'text' => $value['description'] ?? $value['text'] ?? '',
          ];
        }
      }

      if (empty($values)) {
        $values = $default_values;
      }

      $values_title = $values_title ?: __('Nuestros pilares', 'radio-huaya');
      ?>

      <section class="radio-hero" style="--radio-hero-bg: url('<?php echo esc_url($hero_image); ?>');">
        <div class="radio-hero__overlay" aria-hidden="true"></div>
        <div class="radio-hero__content">
          <?php if (!empty($hero_label)) : ?>
            <span class="radio-hero__eyebrow"><?php echo esc_html($hero_label); ?></span>
          <?php endif; ?>
          <h1 class="radio-hero__title"><?php the_title(); ?></h1>
          <?php if (!empty($hero_description)) : ?>
            <p class="radio-hero__description"><?php echo esc_html($hero_description); ?></p>
          <?php elseif (has_excerpt()) : ?>
            <p class="radio-hero__description"><?php echo esc_html(get_the_excerpt()); ?></p>
          <?php endif; ?>
        </div>
      </section>

      <div class="radio-page__body">
        <?php foreach ($sections as $section) :
          $section_classes = ['radio-section'];
          if ($section['alignment'] === 'right') {
            $section_classes[] = 'radio-section--image-right';
          }
          ?>
          <section class="<?php echo esc_attr(implode(' ', $section_classes)); ?>">
            <div class="radio-section__media">
              <img class="radio-section__image" src="<?php echo esc_url($section['image_url']); ?>" alt="<?php echo esc_attr($section['image_alt']); ?>" loading="lazy">
            </div>
            <div class="radio-section__content">
              <?php if (!empty($section['eyebrow'])) : ?>
                <span class="radio-section__eyebrow"><?php echo esc_html($section['eyebrow']); ?></span>
              <?php endif; ?>
              <?php if (!empty($section['title'])) : ?>
                <h2 class="radio-section__title"><?php echo esc_html($section['title']); ?></h2>
              <?php endif; ?>
              <?php if (!empty($section['description'])) : ?>
                <div class="radio-section__description">
                  <?php echo wp_kses_post(wpautop($section['description'])); ?>
                </div>
              <?php endif; ?>
            </div>
          </section>
        <?php endforeach; ?>

        <?php if (!empty($values)) : ?>
          <section class="radio-values" aria-labelledby="radio-values-title">
            <header class="radio-values__header">
              <h2 id="radio-values-title" class="radio-values__title"><?php echo esc_html($values_title); ?></h2>
              <?php if (!empty($values_description)) : ?>
                <p class="radio-values__description"><?php echo esc_html($values_description); ?></p>
              <?php endif; ?>
            </header>
            <div class="radio-values__grid">
              <?php foreach ($values as $value) : ?>
                <article class="radio-values__item">
                  <?php if (!empty($value['title'])) : ?>
                    <h3 class="radio-values__item-title"><?php echo esc_html($value['title']); ?></h3>
                  <?php endif; ?>
                  <?php if (!empty($value['text'])) : ?>
                    <p class="radio-values__item-text"><?php echo esc_html($value['text']); ?></p>
                  <?php endif; ?>
                </article>
              <?php endforeach; ?>
            </div>
          </section>
        <?php endif; ?>

        <?php if ('' !== get_post()->post_content) : ?>
          <section class="radio-page__content">
            <?php the_content(); ?>
          </section>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php include 'components/c-footer.php';
?>
