<?php
/*-----------------------------------------------------------------------------------*/
/*  enable svg images in media uploader
/*-----------------------------------------------------------------------------------*/
function lightseek_mime_types( $mimes ){
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter( 'upload_mimes', 'lightseek_mime_types' );

/*-----------------------------------------------------------------------------------*/
/*  display svg images on media uploader and feature images
/*-----------------------------------------------------------------------------------*/
function lightseek_admin_head() {

  $css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';

  echo '<style>'.$css.'</style>';
}
add_action('admin_head', 'lightseek_admin_head');


/*-----------------------------------------------------------------------------------*/
/* Set up theme options
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'lightseek_theme_setup' ) ) {
	function lightseek_theme_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );
	}
	add_action( 'after_setup_theme', 'lightseek_theme_setup' );
}


/**
 * Register Font Awesome
 */
function wpb_add_font_awesome() {
	wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
	wp_enqueue_style( 'font-awesome');
}
add_action('wp_print_styles', 'wpb_add_font_awesome');


/**
 * Remove WP Logo from the admin bar
 */
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );
