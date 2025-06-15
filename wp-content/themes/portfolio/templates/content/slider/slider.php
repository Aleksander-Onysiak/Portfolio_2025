<?php
$title = get_sub_field('title');
$slider = get_sub_field('slider');

if (!empty($slider)): ?>
  <section class="slider__section">
    <h2 class="slider__title">
      <?= esc_html($title) ?>
    </h2>
    <div class="slider__container">
      <?php foreach ($slider as $image): ?>
        <img class="slider__image" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" width="48" height="48">
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>
