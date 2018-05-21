<?php get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content', get_post_format() );

                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'frank_theme' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'frank_theme' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . '</span>%title</span>',
                            'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'frank_theme' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'frank_theme' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . '</span></span>',
                        )
                    );

                endwhile;
                ?>

            </main>
        </div>
        <?php get_sidebar(); ?>
    </div>

<?php
get_footer();
