<?php
/**
 * functions and definitions
 *
 * @package lightseek
 */

// Put some options here
Class SeekConfig {
	const TOPBAR = true;
	const SIDEBAR = true;
	const SIDEBAR_ON_PAGES = false;
	const SIDEBAR_W = 8;
	const FOOTER_WIDGETS_COUNT = 4;
	const FOOTER_MENU = true;
	const ENABLE_CUSTOM_HEADER = false;
	const JQUERY_VERSION = 2; // 1, 2, 3
	const MENU_STYLE = 'inline'; // null, 'inline'
}

//Template setup
require get_template_directory() . '/inc/init.php';

//Nav Menus
require get_template_directory() . '/inc/nav.php';

//Template Tags
require get_template_directory() . '/inc/template-tags.php';

//TinyMCE extension
require get_template_directory() . '/inc/tiny-mce.php';

//Widgets
require get_template_directory() . '/inc/widgets.php';

//WooCommerce
if ( class_exists( 'WooCommerce' ) )
	require get_template_directory() . '/inc/woocommerce.php';

/*
 * Set up theme options and variables
 */
if ( ! isset( $content_width ) )
	$content_width = 1110;

if ( ! function_exists( 'lightseek_image_sizes' ) ) {
	function lightseek_image_sizes() {
		set_post_thumbnail_size( 1110, 420, array( 'center', 'center') ); // 16:9
		add_image_size('large-img', 1920, 800);
		add_image_size('medium-img', 860, 400);
		add_image_size('small-img', 640, 267);
	}
	add_action( 'after_setup_theme', 'lightseek_image_sizes' );
}

/**
 * Register menus.
 */
$menusArray = array(
	'primary' => __( 'Menu', 'lightseek' ),
	// Add more menu locations as needed
);

if ( SeekConfig::FOOTER_MENU )
	$menusArray['footer'] =  __( 'Footer Menu', 'lightseek' );

register_nav_menus( $menusArray );

/**
 * Use Google hosting for jQuery.
 */
function google_hosted_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');

		switch ( SeekConfig::JQUERY_VERSION ) {
			case 1:
				wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null);
				break;
			case 3:
				wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', false, null);
				break;
			default:
				wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null);
				break;
		}

		wp_enqueue_script('jquery');
	}
}
add_action('wp_enqueue_scripts', 'google_hosted_jquery');

/**
 * Enqueue scripts and styles.
 */
function lightseek_scripts() {
	// Main CSS
	wp_enqueue_style( 'lightseek-style', get_stylesheet_uri() );

	// Web Font Loader
	// https://github.com/typekit/webfontloader
	wp_enqueue_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', array(), null );

	// Font Awesome async
	wp_enqueue_script( 'fa', 'https://use.fontawesome.com/0581ebd445.js', array(), null );

	// Main Script
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/main.min.js', array( 'jquery', 'webfont' ), '20170202', true );
}
add_action( 'wp_enqueue_scripts', 'lightseek_scripts' );

/**
 * defer/async scripts.
 */
function add_defer_attribute($tag, $handle) {
    if ( 'webfont' !== $handle && 'scripts' !== $handle )
        return $tag;
    return str_replace( ' src', ' defer src', $tag );
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

function add_async_attribute($tag, $handle) {
    if ( 'fa' !== $handle )
        return $tag;
    return str_replace( ' src', ' async src', $tag );
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);


/**
 * Advanced Image Compression
 * https://github.com/ResponsiveImagesCG/wp-tevko-responsive-images
 */
function advanced_image_compression() {
    add_theme_support( 'advanced-image-compression' );
}
add_action( 'after_setup_theme', 'advanced_image_compression' );

/**
 * Custom Header
 */
function lightseek_add_header_support() {
	add_theme_support( 'custom-header', array(
		'header-text'            => false,

		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'width'                  => 1920,
		'height'                 => 760,
		'flex-height'            => false,
		'flex-width'             => false,
		'uploads'                => true,
	) );
}

if ( SeekConfig::ENABLE_CUSTOM_HEADER )
	add_action( 'after_setup_theme', 'lightseek_add_header_support' );

// Actions
require get_template_directory() . '/inc/actions.php';
