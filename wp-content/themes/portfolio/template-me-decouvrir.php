<?= get_header() ?>
<?php if (!empty($image)) : ?>
  <img src="<?= esc_url(get_the_post_thumbnail_url()); ?>"
       alt="<?= esc_attr(get_the_title()); ?>" class="discover_section_img">
<?php endif; ?>
<div class="school_section">
  <?php if (have_rows('schools')): ?>
    <?php while (have_rows('schools')): the_row();
      $ecole = get_sub_field('ecole');
      $formation = get_sub_field('formation');
      $start_date = get_sub_field('start_date');
      $end_date = get_sub_field('end_date');
      ?>
      <div class="school_section_container">
        <h3 class="school_section_title"><?= esc_html($ecole); ?></h3>
        <p class="school_section_description"><?= esc_html($formation); ?></p>
        <p class="school_section_description"><?= esc_html($start_date); ?></p>
        <p class="school_section_description"><?= esc_html($end_date); ?></p>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <p>Sorry, no projects found.</p>
  <?php endif; ?>
</div>
<div class="school_section_text">
  <?php if (have_rows('text')): ?>
    <?php while (have_rows('text')): the_row();
      $title = get_sub_field('title');
      $section = get_sub_field('section');
      $description = get_sub_field('description');
      ?>
      <div class="school_section_text_container">
        <h3 class="school_section_title"><?= esc_html($title); ?></h3>
        <p class="school_section_description"><?= esc_html($section); ?></p>
        <p class="school_section_description"><?= esc_html($description); ?></p>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <p>Sorry, no projects found.</p>
  <?php endif; ?>
</div>
<?= get_footer() ?>
