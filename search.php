<?php get_header(); ?>

<div class="wrap">

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'frank_theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'frank_theme' ); ?></h1>
		<?php endif; ?>
	</header>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'excerpt' );

			endwhile;

			the_posts_pagination(
				array(
					'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'frank_theme' ) . '</span>',
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'frank_theme' ) . '</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'frank_theme' ) . ' </span>',
				)
			);

		else :
		?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'frank_theme' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
