<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div class="left-column">
        <header class="site-header">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        </header>

        <aside class="site-content-overlay">
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

            <?php get_sidebar(); ?>

            <div class="copyright">
                &copy; <?php echo date( 'Y' ); ?>
            </div>
        </aside>
    </div>
