<?php
if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'frank_theme' ); ?>">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside>
