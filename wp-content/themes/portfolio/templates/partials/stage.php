<?php
$stage = get_field('stage');
$stage_headline = get_field('headline');
$stage_text = get_field('text', false, false);
$stage_image = get_field('background_image');
$stage_link = get_field('link');
?>

<section class="stage <?= is_front_page() ? 'stage__home' : ''; ?>">
    <div class="stage__div-text <?= is_front_page() ? 'stage__home__div-text' : ''; ?>">
        <?php if (isset($stage['supline']) && $stage['supline'] !== ""): ?>
            <p class="stage__supline">
                <?= $stage['supline'] ?>
            </p>
        <?php endif; ?>
        <?php if (isset($stage['headline']) && $stage['headline'] !== ""): ?>
            <h1 role="heading" aria-level="1"
                class="stage__headline <?= is_front_page() ? 'stage__home__headline' : ''; ?>">
                <?= $stage['headline'] ?>
            </h1>
        <?php endif; ?>
        <?php if (isset($stage['subline']) && $stage['subline'] !== ""): ?>
            <p class="stage__subline <?= is_front_page() ? 'stage__home__subline' : ''; ?> ">
                <?= $stage['subline'] ?>
            </p>
        <?php endif; ?>
        <div class="test">
            <?php if (isset($stage['text']) && $stage['text'] !== ""): ?>
                <p class="stage__description <?= is_front_page() ? 'stage__home__description' : ''; ?>">
                    <?= $stage['text'] ?>
                </p>
            <?php endif; ?>
        </div>
        <?php if (isset($stage['link']) && $stage['link'] !== ""): ?>
            <a class="stage__cts-btn"
               href="<?= $stage['link']['url'] ?>"
               title="<?= $stage['link']['title'] ?>">
                <?= $stage['link']['title'] ?>
            </a>
        <?php endif; ?>
    </div>

    <?php if (!empty($stage['image'])): ?>
        <div class="stage__div-image">
            <?= responsive_image($stage['image'], [
                'lazy' => 'true',
                'classes' => 'stage__image' . (is_front_page() ? ' stage__home__image' : '')
            ]) ?>
        </div>
    <?php endif; ?>
</section>
