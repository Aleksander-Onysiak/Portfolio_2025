<?php /* Template Name: Page "Contact" */ ?>
<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()): the_post(); // Ouverture de "The Loop" de Wordpress ?>

        <section class="contact__form" style="">
            <h2 role="heading" aria-level="2" class="contact__h2">Et si l’on commençait à travailler ensemble?</h2>
            <?php

            $errors = $_SESSION['dw_contact_form_errors'] ?? [];
            unset($_SESSION['dw_contact_form_errors']);


            $success = $_SESSION['dw_contact_form_success'] ?? false;
            unset($_SESSION['dw_contact_form_success']);

            if ($success): ?>
                <p class="contact__success"><?= $success; ?></p>
            <?php else: ?>

                <form action="<?= esc_url(admin_url('admin-post.php')); ?>" method="POST" class="form">
                    <fieldset class="form__fields">
                        <div class="field">
                            <label for="name" class="field__label">
                                Prénom
                            </label>
                            <input type="text" name="name" id="name" class="field__input" placeholder="Nom / Prénom">
                            <?php if (isset($errors['name'])): ?>
                                <p class="field__error"><?= $errors['name']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="field">
                            <label for="email" class="field__label">
                                Adresse mail
                            </label>
                            <input type="email" name="email" id="email" class="field__input" placeholder="Email">
                            <?php if (isset($errors['email'])): ?>
                                <p class="field__error"><?= $errors['email']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="field">
                            <label for="subject" class="field__label">
                                Sujet
                            </label>
                            <input type="text" name="subject" id="subject" class="field__input" placeholder="Sujet">
                            <?php if (isset($errors['subject'])): ?>
                                <p class="field__error"><?= $errors['subject']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="field">
                            <label for="message" class="field__label">
                                Message
                            </label>
                            <textarea name="message" id="message" class="field__input" placeholder="Message"></textarea>
                            <?php if (isset($errors['message'])): ?>
                                <p class="field__error"><?= $errors['message']; ?></p>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <div class="form__submit">
                        <?php
                        // Cet input hidden permet de spécifier à WP (via l'appel d'URL "admin-post.php") que c'est notre fonction de traitement "dw_handle_contact_form_submit" qu'il faut appeler lorsque ces données seront envoyées.
                        ?>
                        <input type="hidden" name="action" value="dw_contact_form_submit">
                        <button type="submit" class="btn">Envoyer</button>
                    </div>
                </form>
            <?php endif; ?>
        </section>

<?php endwhile; endif; // Fermeture de "The Loop" de Wordpress ?>
<?php get_footer(); ?>

