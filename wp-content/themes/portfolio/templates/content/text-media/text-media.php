<?php $headline = get_sub_field('headline'); ?>
<?php $text = get_sub_field('text', false, false); ?>
<?php $link = get_sub_field('link'); ?>
<?php $image = get_sub_field('image'); ?>
<?php $media_position = get_sub_field('media_position'); ?>
<?php $media_type = get_sub_field('media_type'); ?>

<?php if ($headline || $text || $link || $image || $media_type): ?>
    <section class="text-media text-media__position--<?= esc_attr($media_position) ?>">
        <div class="text-media_media">
            <?php if ($media_type === 'image' && !empty($image)): ?>
                <?= responsive_image($image, ['lazy' => 'true', 'classes' => 'text-media__image']) ?>
            <?php elseif ($media_type === 'video'): ?>
                <video class="text-media__video" controls>
                </video>
            <?php endif; ?>
        </div>
        <div class="text-media__content-container">
            <?php if (!empty($headline)): ?>
                <h2 class="text-media__content-title">
                    <?= $headline ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($text)): ?>
                <div class="text-media__content-text">
                    <?= $text ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($link) && isset($link['url'], $link['title'])): ?>
                <a class="text-media__content-link"
                   href="<?= esc_url($link['url']) ?>"
                   target="<?= isset($link['target']) && $link['target'] === '_blank' ? '_blank' : '_self' ?>">
                    <?= esc_html($link['title']) ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
