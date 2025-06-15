<?= get_header() ?>

<?php
$stage_headline = get_field('headline');
$stage_subline = get_field('subline');
$stage_link = get_field('link');
?>

<div class="front-wrapper-background">
  <section class="front-wrapper">
    <h2 class="front-stage-headline">
      <strong class="front-stage-headline--strong"><?= $stage_headline ?></strong>
      <?= $stage_subline ?>
    </h2>
    <a class="front-stage-link" href="<?= $stage_link['url'] ?>" title="<?= $stage_link['title'] ?>">
      <?= $stage_link['title'] ?>
    </a>
  </section>
</div>

<?php include('templates/flexible.php'); ?>

<section class="end-quote">
  <h2 class="end_contact__title"><?= __('Un Projet, une Idée ?', 'textdomain') ?></h2>
  <p class="end_contact__subtitle"><?= __('Contactez-moi pour un stage', 'textdomain') ?></p>
  <a class="btn-contact" href="#"><?= __('Me contacter', 'textdomain') ?></a>
</section>

<?= get_footer() ?>

