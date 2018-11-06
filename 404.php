<?php get_header(); ?>

    <main id="content" class="site-content" role="main">

    <section class="page error-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'frank_theme' ); ?></h1>
        </header>

        <div class="page-content">
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'frank_theme' ); ?></p>

            <?php get_search_form(); ?>
        </div>
    </section>

</main>

<?php get_footer();