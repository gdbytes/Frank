<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div id="page" class="container">

	    <header id="masthead" class="row">

            <h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php the_header_image_tag(); ?>

            <nav id="site-nav">
                <?php if ( !dynamic_sidebar( 'Navigation' ) ) : ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'frank_primary_navigation', 'container' => false ) ); ?>
                <?php endif; ?>
            </nav>

            <?php if ( is_active_sidebar( 'widget-subheader' ) ) : ?>
                <div id='sub-header' class='row'>
                    <?php if ( !dynamic_sidebar( 'Sub Header' ) ) : ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
	    </header>
