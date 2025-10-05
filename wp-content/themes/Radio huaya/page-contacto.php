<?php
/**
 * Template Name: Plantilla de contacto
 */

get_header();
?>

<main id="main" class="contact-template">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="contact-template__wrapper">
                <section class="contact-template__map" aria-label="Ubicación en el mapa">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3764.620759851717!2d-99.13317822377937!3d19.34374448693317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fff3e95f9643%3A0x9b13b6a1dc16109c!2sCiudad%20de%20M%C3%A9xico%2C%20CDMX%2C%20M%C3%A9xico!5e0!3m2!1ses!2smx!4v1700000000000!5m2!1ses!2smx"
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Mapa de contacto">
                    </iframe>
                </section>
                <section class="contact-template__form">
                    <header class="contact-template__header">
                        <h1 class="contact-template__title"><?php the_title(); ?></h1>
                        <div class="contact-template__content">
                            <?php the_content(); ?>
                        </div>
                    </header>
                    <form class="contact-template__form-fields" action="#" method="post">
                        <div class="contact-template__field">
                            <label class="contact-template__label" for="contact-name">Nombre</label>
                            <input class="contact-template__input" type="text" id="contact-name" name="contact-name" required>
                        </div>
                        <div class="contact-template__field">
                            <label class="contact-template__label" for="contact-email">Correo electrónico</label>
                            <input class="contact-template__input" type="email" id="contact-email" name="contact-email" required>
                        </div>
                        <div class="contact-template__field">
                            <label class="contact-template__label" for="contact-phone">Teléfono</label>
                            <input class="contact-template__input" type="tel" id="contact-phone" name="contact-phone">
                        </div>
                        <div class="contact-template__field">
                            <label class="contact-template__label" for="contact-message">Mensaje</label>
                            <textarea class="contact-template__textarea" id="contact-message" name="contact-message" rows="5" required></textarea>
                        </div>
                        <div class="contact-template__actions">
                            <button class="contact-template__submit" type="submit">Enviar mensaje</button>
                        </div>
                    </form>
                </section>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php
get_footer();
