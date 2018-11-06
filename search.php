<?php get_header(); ?>

    <main id="content" class="site-content" role="main">

        <header class="page-header">
            <?php if ( have_posts() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'frank_theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            <?php else : ?>
                <h1 class="page-title"><?php _e( 'Nothing Found', 'frank_theme' ); ?></h1>
            <?php endif; ?>
        </header>

        <div class="entry-content">
            <?php
            if ( have_posts() ) :

                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', 'search' );

                endwhile;

                the_posts_pagination();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
        </div>
    </main>

<?php
get_footer();
