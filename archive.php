<?php get_header(); ?>

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header>
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :
		?>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination(
				array(
					'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'frank_theme' ) . '</span>',
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'frank_theme' ) . '</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'frank_theme' ) . ' </span>',
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
