<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$link = get_sub_field('link');
$gallery = get_sub_field('gallery');
$gallery_class = count($gallery) === 1 ? 'gallery--single' : '';

if (!empty($gallery)): ?>
    <section class="gallery_container <?= esc_attr($gallery_class) ?>">
        <div class="gallery_container-header<?= empty($description) ? ' no-description' : '' ?>">
            <h2 class="gallery__title">
                <?= esc_html($title) ?>
            </h2>

            <?php if (!empty($description)): ?>
                <p class="gallery__description">
                    <?= esc_html($description) ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($link)): ?>
                <a class="stage__cts-btn" href="<?= esc_html($link) ?>">
                    Consulter ma page Instagram
                </a>
            <?php endif; ?>
        </div>

        <div class="gallery__main" style="display:none;">
            <img src="<?= esc_url($gallery[0]['url']) ?>" alt="<?= esc_attr($gallery[0]['alt']) ?>" class="gallery__main-image" />
            <button class="close-button" aria-label="Fermer la galerie">X</button>
        </div>

        <div class="gallery_container-img">
            <?php foreach ($gallery as $image): ?>
                <div class="gallery__item" data-lightroom-item>
                    <?= wp_get_attachment_image($image['ID'], 'large', false, [
                        'class' => 'gallery__image',
                        'data-full' => esc_url($image['url']),
                        'alt' => esc_attr($image['alt']),
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
