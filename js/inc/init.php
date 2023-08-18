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
		/* Custom logo introduced in WP 4.5 */
		add_theme_support( 'custom-logo', array(
			'header-text'	=> array( 'site-title', 'site-description' ),
		) );
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );
		/* JetPack Infinite Scroll support */
		add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
	}
	add_action( 'after_setup_theme', 'lightseek_theme_setup' );
}


/**
 * Register Font Awesome
 */
/*function wpb_add_font_awesome() {
	wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null);
	wp_enqueue_style( 'font-awesome');
}*/
//add_action('wp_print_styles', 'wpb_add_font_awesome');


/**
 * Remove WP Logo from the admin bar
 */
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'comments' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );


/**
 * Disable Emoji
 */
add_action( 'init', 'lightseek_disable_wp_emojicons' );
add_filter( 'emoji_svg_url', '__return_false' );

function lightseek_disable_wp_emojicons() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'lightseek_disable_emojicons_tinymce' );
}

function lightseek_disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
