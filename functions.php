<?php
require_once 'admin/frank-theme-options.php';

if (! function_exists('frank_theme_setup')):
    function frank_theme_setup() {
        load_theme_textdomain( 'frank_theme', get_template_directory() . '/languages' );

        register_nav_menus([
            'primary-menu' => esc_html__( 'Primary Menu', 'frank_theme' ),
        ]);

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
        ) );

        add_theme_support( 'custom-background', apply_filters( 'frank_theme_custom_background_args', array(
			'default-color' => 'fffefe',
			'default-image' => ''
        ) ) );

        add_theme_support( 'customize-selective-refresh-widgets' );

        add_image_size( 'post-image', 535, 9999 );
        add_image_size( 'featured-image', 980, 200, true );
        add_image_size( 'header-image', 980, 225, true );
        add_image_size( 'excerpt-image', 724, 160, true );
        add_image_size( 'default-thumbnail', 535, 200, true );
        add_image_size( 'two-up-thumbnail', 468, 200, true );
        add_image_size( 'three-up-thumbnail', 297, 150, true );
        add_image_size( 'four-up-thumbnail', 212, 100, true );

        add_theme_support( 'custom-header', array(
            'size' => 'header-image',
            'width' => 980,
            'height' => 225,
            'flex-height' => true,
            'wp-head-callback' => 'frank_theme_header_style',
        ) );

        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
    }
endif;
add_action( 'after_setup_theme', 'frank_theme_setup' );

/**
 * Clean up widget settings that weren't set at installation.
 * If never used in the sidebar, their lack of default options will
 * trigger queries every page load.
 */
function frank_set_missing_widget_options() {
	add_option( 'widget_pages', array( '_multiwidget' => 1 ) );
	add_option( 'widget_calendar', array( '_multiwidget' => 1 ) );
	add_option( 'widget_tag_cloud', array( '_multiwidget' => 1 ) );
	add_option( 'widget_nav_menu', array( '_multiwidget' => 1 ) );
}
add_action( 'after_switch_theme', 'frank_set_missing_widget_options' );

function frank_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'frank_theme_content_width', 980 );
}
add_action( 'after_setup_theme', 'frank_theme_content_width', 0 );

function frank_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => 'Sub Header',
			'id'      		=> 'widget-subheader',
			'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      	=> 'Navigation',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      	=> 'Index Right Aside',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      	=> 'Post Left Aside',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      	=> 'Post Right Aside',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      	=> 'Post Footer',
			'id'      		=> 'widget-postfooter',
			'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      	=> 'Footer',
			'id'     	 	=> 'widget-footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s six columns">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			)
	);
}
add_action( 'widgets_init', 'frank_theme_widgets_init' );

function frank_enqueue_assets() {
    wp_enqueue_style( 'frank_stylesheet', get_stylesheet_uri() );
    wp_enqueue_script('frank_scripts', get_stylesheet_directory_uri() . '/frank.js', [], null);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
    }

    if ( frank_get_option( 'enable_wp_embed') != true) {
        wp_deregister_script( 'wp-embed' );
    }
}

function frank_enqueue_admin_assets() {
	wp_enqueue_style( 'frank-admin', get_template_directory_uri() . '/resources/assets/css/frank-options.css', [], null, null);
	wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'frank-admin', get_template_directory_uri() . '/resources/assets/js/frank-utils.js', 'jquery', null, true );

	wp_localize_script( 'frank-admin', 'admin_strings', [
        'delete_section_alert' => __( 'Are you sure you want to delete this Content Section?', 'frank_theme' ),
        'drag_section_instruction' => '&larr; ' . __('(Drag & Drop Content Sections to Re-Order)', 'frank_theme' )
    ] );
}

add_action( 'init', ( is_admin() ? 'frank_enqueue_admin_assets' : 'frank_enqueue_assets' ) );

function frank_remove_version_from_query_string( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }

	return $src;
}

if ( frank_get_option( 'remove_script_version' ) ){
	add_filter( 'script_loader_src', 'frank_remove_version_from_query_string', 15, 1 );
}

if ( frank_get_option( 'remove_style_version' ) ){
	add_filter( 'style_loader_src', 'frank_remove_version_from_query_string', 15, 1 );
}

/**
 * Include template functions.
 */
require_once get_template_directory() . '/includes/template-tags.php';

function frank_get_option( $key ) {

    $frank_options = get_option( '_frank_options' );

    /* Define the array of defaults */
    $defaults = array(
            'header' => '',
            'footer' => '',
            'tweet_post_button' => false,
            'enable_wp_embed' => false,
            'tweet_post_attribution' => '',
            'sections' => array(
            'display_type' => 'default_loop',
            'header' => false,
            'title' => '',
            'caption' => '',
            'num_posts' => 10,
            'categories' => array(),
            'default' => true,
        )
    );

    $frank_options = wp_parse_args( $frank_options, $defaults );

    if ( isset( $frank_options[ $key ] ) ) {
        return $frank_options[ $key ];
    }

    return false;
}

function frank_footer() {
	echo stripslashes( frank_get_option( 'footer' ) );
}
add_action( 'wp_footer', 'frank_footer' );

function frank_header() {
	echo stripslashes( frank_get_option( 'header' ) );
}
add_action( 'wp_head', 'frank_header' );

function frank_tweet_post_button() {
	if ( frank_get_option( 'tweet_post_button' ) ) {
        return true;
    }
}

function frank_tweet_post_attribution() {
	return frank_get_option( 'tweet_post_attribution' );
}

function frank_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment; ?>

    <li id="comment-<?php comment_ID() ?>" class="comment">
        <div class="row">
            <div class="comment-content">
                <?php
                    if ( $comment->comment_approved == '0' ) {
                        $moderation_pending = __( 'Your comment is awaiting moderation', 'frank_theme' );
                        echo '<span class="comment-moderation">' . $moderation_pending . '</span>';
                    }
                    comment_text();
                ?>
                <div class="comment-reply">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
                </div>
            </div>
            <div class="comment-info">
                <ul class='metadata vertical'>
                    <li class="date"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><span class="date-date"><?php comment_date( 'F d, Y' ); ?></span> <span class="date-time"><?php comment_date( 'g:i A' ); ?></span></time></li>
                    <li class='author' id="vcard-<?php comment_ID() ?>">
                        <?php
                            echo _x( 'By', 'comment_author_attribution', 'frank_theme' );
                            echo ' ';
                            ?>
                            <a class="url fn" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></li>
                    <li>
                        <?php edit_comment_link( _x( 'edit', 'edit-comment', 'frank_theme' ) ); ?>
                    </li>
                </ul>
            </div>
        </div>
<?php
}

function frank_theme_header_style() {
    $header_text_color = get_header_textcolor();

    if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
        return;
    }

    echo '<style>';
    if ( ! display_header_text() ) :
?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px, 1px, 1px, 1px);
        }
    <?php else : ?>
        .site-title a,
        .site-description {
            color: #<?php echo esc_attr( $header_text_color ); ?>;
        }
    <?php
    endif;
    echo '</style>';
}
