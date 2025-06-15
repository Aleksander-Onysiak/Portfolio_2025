<?php
$project_headline = get_sub_field('project_headline');
$project_link = get_sub_field('project_link');
?>

<section class="front-project__container">
  <div class="front-project__text-wrapper">
    <h2 role="heading" aria-level="2" class="front-project__text-title">
      <?= $project_headline ?>
    </h2>
    <a class="front-project__text-link" href="<?= $project_link['url'] ?>"
       title="<?= $project_link['title'] ?>">
      <?= $project_link['title'] ?>
    </a>
  </div>

  <?php
  $projets = new WP_Query([
    'post_type' => 'project',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'lang' => '',
  ]);
  ?>
  <div class="front-project__data-container">
    <?php if ($projets->have_posts()) :
      while ($projets->have_posts()) : $projets->the_post(); ?>
        <article tabindex="0" class="front-project__data-single">
          <img class="front-project__data-single-image" src="<?= get_the_post_thumbnail_url() ?>" alt=""
               width="250" height="250">
          <h3 role="heading" aria-level="3" class="front-project__data-single-title"><?= get_the_title(); ?></h3>
          <p class="front-project__data-single-placeholder">Voir le projet</p>
          <a class="front-project__data-single-link" href="<?= get_the_permalink(); ?>"
             title="Ce lien vous amènera vers la page du projet">
            Vers la page du projet <?= get_the_title(); ?>
          </a>
        </article>
      <?php endwhile;
      wp_reset_postdata(); endif; ?>
  </div>
</section>
