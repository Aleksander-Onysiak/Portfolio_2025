<?php
if (get_row_layout() === 'grid-card'):
    $grid_title = get_sub_field('grid_title');
    $cards = get_sub_field('grid-card-repeater');

    if (!empty($cards)): ?>
        <section class="grid-container">

            <?php if (!empty($grid_title)): ?>
                <div class="grid-container__header">
                    <h2 class="grid-container__header-title" aria-level="2" role="heading">
                        <?= esc_html($grid_title); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <div class="grid-cards">
                <?php foreach ($cards as $card):
                    $title = $card['title'];
                    $description = $card['description'];
                    ?>
                    <article class="grid-card">
                        <?php if (!empty($title)): ?>
                            <h3 class="grid-card-header-title"><?= esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($description)): ?>
                            <p class="grid-card-description"><?= wp_kses_post($description); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>

        </section>
    <?php endif;
endif;
?>
