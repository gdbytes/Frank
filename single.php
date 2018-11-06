<?php get_header(); ?>

    <main id="content" class="site-content" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php
                get_template_part( 'template-parts/content', get_post_format() );
                the_post_navigation(['screen_reader_text' => __( 'Further Reading' )]);

                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>

        <?php endwhile; ?>

    </main>

<?php get_footer();
