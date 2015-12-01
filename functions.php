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
}

//Template setup
require get_template_directory() . '/inc/init.php';

//Load Jetpack compatibility file
require get_template_directory() . '/inc/jetpack.php';

//Nav Menus
require get_template_directory() . '/inc/nav.php';

//Template Tags
require get_template_directory() . '/inc/template-tags.php';

//TinyMCE extension
require get_template_directory() . '/inc/tiny-mce.php';

//Widgets
require get_template_directory() . '/inc/widgets.php';

//WooCommerce
require get_template_directory() . '/inc/woocommerce.php';

// TODO Add WooCommerce plugin settings
/*if ( class_exists( 'WooCommerce' ) )
	require get_template_directory() . '/inc/woo.php';*/

/*
 * Set up theme options and variables
 */
if ( ! isset( $content_width ) )
	$content_width = 1200;

if ( ! function_exists( 'lightseek_image_sizes' ) ) {
	function lightseek_image_sizes() {
		set_post_thumbnail_size( 1200, 420, array( 'center', 'center') ); // 16:9
		add_image_size('large-img', 1920, 800);
		add_image_size('medium-img', 860, 400);
		add_image_size('small-img', 640, 267);
	}
	add_action( 'after_setup_theme', 'lightseek_image_sizes' );
}

/**
 * Register menus.
 */
register_nav_menus( array(
	'primary' => __( 'Menu', 'baseek' ),
) );

/**
 * Enqueue scripts and styles.
 */
function lightseek_scripts() {
	// Main CSS
	wp_enqueue_style( 'lightseek-style', get_stylesheet_uri() );

	// Web Font Loader
	// https://github.com/typekit/webfontloader
	wp_enqueue_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js', array(), '1.5.18', true );

	// Main Script
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'webfont' ), '20151010', true );
}
add_action( 'wp_enqueue_scripts', 'lightseek_scripts' );

/**
 * Google Webfonts
 */
function lightseek_add_google_fonts() {
	//$gfonts  = 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300|Roboto:400,300,500,400italic,500italic,700,700italic|Source+Code+Pro:400,700';
	$gfonts  = 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300';
	wp_register_style('lightseek-googleFonts', $gfonts);
	wp_enqueue_style( 'lightseek-googleFonts');
}
//add_action('wp_print_styles', 'lightseek_add_google_fonts');


/**
 * Advanced Image Compression
 * https://github.com/ResponsiveImagesCG/wp-tevko-responsive-images
 */
function advanced_image_compression() {
    add_theme_support( 'advanced-image-compression' );
}
add_action( 'after_setup_theme', 'advanced_image_compression' );
