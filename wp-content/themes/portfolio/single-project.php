<?php get_header(); ?>

<?php
$post_id = get_the_ID();
$background_image = get_field('header_image');

if (have_rows('projects_links', $post_id)) :
  while (have_rows('projects_links', $post_id)) : the_row();
    $project_link = get_sub_field('project_link');
    $project_git = get_sub_field('project_git');
    ?>
    <section class="single-header">
      <h2 class="single-header-title"><?= get_the_title() ?></h2>
      <div class="single-header-links">
        <?php if ($project_link): ?>
          <a class="single-header-link" href="<?= esc_url($project_link); ?>">Voir le site</a>
        <?php endif; ?>
        <?php if ($project_git): ?>
          <a class="single-header-link" href="<?= esc_url($project_git); ?>">Voir le GitHub</a>
        <?php endif; ?>
      </div>
      <img class="single-header-image" src="<?= $background_image['url'] ?>" height="<?= $background_image['height'] ?>"
           width="<?= $background_image['width'] ?>" alt="<?= $background_image['alt'] ?>">
    </section>
  <?php endwhile;
endif;

if (have_rows('projects', $post_id)) :
  while (have_rows('projects', $post_id)) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description', false, false);
    $image = get_sub_field('image');
    $image_2 = get_sub_field('image_2');
    ?>
    <section class="project_section">
      <div class="project_section_heading">
        <?php if ($title): ?>
          <h2 class="project_section_title"><?= esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($description): ?>
          <p class="project_section_description"><?= esc_html($description); ?></p>
        <?php endif; ?>
      </div>

      <div class="project_image_container">
        <?php if ($image): ?>
          <?php if (is_array($image)): ?>
            <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt']); ?>"
                 class="project_section_img">
          <?php else: ?>
            <img src="<?= esc_url($image); ?>" alt="" class="project_section_img">
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($image_2): ?>
          <?php if (is_array($image_2)): ?>
            <img src="<?= esc_url($image_2['url']); ?>" alt="<?= esc_attr($image_2['alt']); ?>"
                 class="project_section_img">
          <?php else: ?>
            <img src="<?= esc_url($image_2); ?>" alt="" class="project_section_img">
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </section>
  <?php endwhile;
endif;
?>

<?php
$project_headline = "Passionné par le développement, voici quelques unes de mes réalisations récentes";
?>

<section class="front-project__container">
  <div class="front-project__text-wrapper">
    <h2 role="heading" aria-level="2" class="front-project__text-title">
      <?= $project_headline ?>
    </h2>
    <a class="front-project__text-link" href="/contact"
       title="Se diriger vers ma page de contact">
      Me contacter
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

<?php get_footer(); ?>
