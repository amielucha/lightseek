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
	const SIDEBAR_W = 8;
	const FOOTER_WIDGETS_COUNT = 4;
	const FOOTER_MENU = true;
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
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, '1.12.4');
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
	wp_enqueue_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js', array(), '1.6.16', true );

	// FitVids
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '20160206', true );

	// Main Script
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'webfont', 'fitvids' ), '20151010', true );
}
add_action( 'wp_enqueue_scripts', 'lightseek_scripts' );

/**
 * Advanced Image Compression
 * https://github.com/ResponsiveImagesCG/wp-tevko-responsive-images
 */
function advanced_image_compression() {
    add_theme_support( 'advanced-image-compression' );
}
add_action( 'after_setup_theme', 'advanced_image_compression' );
