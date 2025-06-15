<?= get_header('custom') ?>

    <script src="src/js/main.js"></script>
    <section class="my-projects">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="content"><?= get_the_content() ?></div>
        <?php endwhile; else : ?>

            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </section>
    <!--on ferme la boucle-->

<?= get_footer('custom') ?>