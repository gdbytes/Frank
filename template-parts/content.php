<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			} ?>
	</header>

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
        <?php
            if ( is_single() ) {
    			/* translators: %s: Name of current post */
                the_content( sprintf(
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'frank_theme' ),
                    get_the_title()
                ) );

                wp_link_pages( array(
                    'before'      => '<div class="page-links">' . __( 'Pages:', 'frank_theme' ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) );
            } else {
                the_excerpt();
            }
		?>
    </div>

    <footer class="entry-footer">

        <?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
                <?php if ( is_single() ) : frank_posted_on(); ?>
                <?php else: echo frank_time_link(); endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( is_single() ) : ?>
            <?php frank_entry_footer(); ?>
        <?php endif; ?>

    </footer>

    <?php if ( is_single() ) : ?>
        <section class="subscribe">
            <a href="<?php bloginfo('rss_url'); ?>" class="btn btn-primary btn-full-width btn-block">Get the latest posts delivered to your inbox. Subscribe via RSS</a>
        </section>
    <?php endif; ?>

</article>
