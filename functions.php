<?php
/**
 * functions and definitions
 *
 * @package lightseek
 */

// Put some options here
Class SeekConfig {
	const TOPBAR = false;
	const SIDEBAR = false;
	const SIDEBAR_ON_PAGES = false;
	const SIDEBAR_W = 8;
	const FOOTER_WIDGETS_COUNT = 1;
	const FOOTER_MENU = false;
	const ENABLE_CUSTOM_HEADER = false;
	const JQUERY_VERSION = 2; // 1, 2, 3
	const FRONT_PAGE_SECTIONS = 0; // 0, 1, 2, 3, 4...
	const READ_MORE_BUTTON = true;
	const MENU_STYLE = 'inline'; // null, 'inline'
}

//Template setup
require get_template_directory() . '/inc/init.php';

//Nav Menus
require get_template_directory() . '/inc/nav.php';

//Template Tags
require get_template_directory() . '/inc/template-tags.php';

// Front Page Sections
if ( SeekConfig::FRONT_PAGE_SECTIONS )
	require get_template_directory() . '/inc/front-page-sections.php';

//TinyMCE extension
require get_template_directory() . '/inc/tiny-mce.php';

//Widgets
require get_template_directory() . '/inc/widgets.php';

//WooCommerce
if ( class_exists( 'WooCommerce' ) )
	require get_template_directory() . '/inc/woocommerce.php';


function iseek_add_block_category($categories)
	{
		$categories[] = array(
			'slug'  => 'iseek-blocks',
			'title' => 'iSeek Blocks'
		);
	
		return $categories;
	}
add_filter('block_categories', 'iseek_add_block_category');


/**
 * ACF Pro blocks.
 */
require_once get_template_directory() . '/blocks/blocks.php';	


/*
 * Set up theme options and variables
 */
if ( ! isset( $content_width ) )
	$content_width = 1110;

if ( ! function_exists( 'lightseek_image_sizes' ) ) {
	function lightseek_image_sizes() {
		set_post_thumbnail_size( 1110, 420, array( 'center', 'center') ); // 16:9
		//add_image_size('large-img', 1920, 800);
		//add_image_size('medium-img', 860, 400);
		//add_image_size('small-img', 640, 267);
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
				wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, null);
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

	wp_enqueue_style( 'additional-css', get_template_directory_uri() . '/additional_css.css', array(), '20230301' );

	// Web Font Loader
	// https://github.com/typekit/webfontloader
	wp_enqueue_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', array(), null );

	// Font Awesome async
	wp_enqueue_script( 'fa', 'https://use.fontawesome.com/0581ebd445.js', array(), null );

	// Main Script
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/main.min.js', array( 'jquery', 'webfont' ), '20170202', true );

	// Utils Script
	wp_enqueue_script( 'util', get_template_directory_uri() . '/js/src/bootstrap/util.js', array( 'jquery' ), '20160530', true );

	// Tabs Script
	wp_enqueue_script( 'tabs', get_template_directory_uri() . '/js/src/bootstrap/tab.js', array( 'jquery' ), '20160530', true );

	// Collapse Script
	wp_enqueue_script( 'collapse', get_template_directory_uri() . '/js/src/bootstrap/collapse.js', array( 'jquery' ), '20160530', true );

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

// Display Read More on new line as a button
function lightseek_read_more_link() {
	return '<p><a class="btn btn-primary" href="' . get_permalink() . '">Read More</a></p>';
}

if ( SeekConfig::READ_MORE_BUTTON )
	add_filter( 'the_content_more_link', 'lightseek_read_more_link' );

// If we have ACF Pro plugin active, enable Options Page.
if( function_exists('acf_add_options_page') )
	acf_add_options_page();

// Actions
require get_template_directory() . '/inc/actions.php';


// [download title="value" link="value"]
function download_func( $atts ) {
    $a = shortcode_atts( array(
        'title' => 'Download Info',
        'link' => '',
    ), $atts );

    if (empty($a['link'])) return "";

    return '<a class="download-link" href="' . $a['link'] .'">' . $a['title'] . '</a></div>';
}
add_shortcode( 'download', 'download_func' );


// [accordion title="value"]
function accordion_func( $atts, $content = null ) {
    $a = shortcode_atts( array(
        'title' => '',
    ), $atts );

    $id = rand(1,1000);

   	ob_start();
	?>

    <div class="collapse-btn">
       <a data-toggle="collapse" data-parent="#cs_accordion" href="#collapse<?php echo $id; ?>" aria-expanded="false" class="collapsed">
                      <?php echo $a['title']; ?>
       </a>
   		</div>
       <div id="collapse<?php echo $id; ?>" class="collapse">
    			<div class="card card-block">
                	<?php echo $content; ?>

                </div>
       </div>

<?php
	return ob_get_clean();             


}
add_shortcode( 'accordion', 'accordion_func' );



// [panels]
function panels_func( $atts ) {
    global $post;

    if( have_rows('panel_', $post->ID) ):
			 
		$panel_titles = array();
		$panel_contents = array();

		while( have_rows('panel_', $post->ID) ): the_row(); 
			// vars
			$panel_titles[] = get_sub_field('panel_title');
			$panel_contents[] = get_sub_field('panel_content');

		endwhile;

    ob_start();
	?> 
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	<?php 
		$i=0;
		foreach($panel_titles as $title) { ?>
	   
	    <li class="nav-item">
	   		<a class="nav-link <?php echo ($i==0) ? 'active' : ''; ?>" data-toggle="tab" href="#<?php echo strtolower(str_replace(' ', '_', $title)); ?>" role="tab"><?php echo $title; ?></a>
	    </li>

	<?php 
		$i++;
		} ?>

	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	<?php

		$i=0;
		foreach($panel_contents as $key => $contents) { ?>
			<div class="tab-pane <?php echo ($i==0) ? 'active' : ''; ?>" id="<?php echo strtolower(str_replace(' ', '_', $panel_titles[$key])); ?>" role="tabpanel"><?php echo $contents; ?></div>

		<?php 
		  $i++;
		} ?>
	</div>
	<?php
	return ob_get_clean();

    endif;


}
add_shortcode( 'panels', 'panels_func' );


//[faqs]
function faqs_shortcode( $atts ) {
global $post;

	$faq = get_field('faq', $post->ID);
	$id = rand(1,1000);

   ob_start();
	?>
       <div class="collapse-btn">
       <a data-toggle="collapse" data-parent="#cs_accordion" href="#collapse<?php echo $id; ?>" aria-expanded="false" class="collapsed">
                      <?php _e('FAQs', 'lightseek'); ?>
       </a>
   		</div>
       <div id="collapse<?php echo $id; ?>" class="collapse">
                 <div class="card card-block">
                 	<?php echo $faq; ?>
                  </div>
       </div>

<?php
	return ob_get_clean();

}
add_shortcode( 'faqs', 'faqs_shortcode' );



function new_excerpt_more() {
       return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
	$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
	}
add_filter( 'body_class', 'add_slug_body_class' );

function lightseek_setup_theme_supported_features() {
  
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Teal', 'lightseek' ),
				'slug'  => 'brand-primary',
				'color'	=> '#21a19f',
			),
			array(
				'name'  => __( 'Theme Purple', 'lightseek' ),
				'slug'  => 'brand-secondary',
				'color' => '#b13ee5',
			),
			array(
				'name'  => __( 'Theme Blue', 'lightseek' ),
				'slug'  => 'theme-blue',
				'color' => '#1787e0',
			   ),
			array(
				'name'  => __( 'Theme Light Blue', 'lightseek' ),
				'slug'  => 'theme-light-blue',
				'color' => '#c4e1f7',
			   ),
			   array(
				'name'  => __( 'Slate', 'lightseek' ),
				'slug'  => 'slate',
				'color' => '#4a5568',
			   ),
			   array(
				'name'  => __( 'Dark', 'lightseek' ),
				'slug'  => 'dark',
				'color' => '#1a202c',
			   ),
			   array(
				'name'  => __( 'Black', 'lightseek' ),
				'slug'  => 'black',
				'color' => '#000000',
			   ),
			   
			));
				
}
add_action( 'after_setup_theme', 'lightseek_setup_theme_supported_features' );

// Move Yoast to bottom
function lightseek_move_yoast() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'lightseek_move_yoast');



//[book_a_demo]
function book_a_demo_shortcode( $atts ) {
	   ob_start();
		?>
		   <div class="book-a-demo">
		   <a class="book-a-demo-link popmake-5454" href="#"><?php echo file_get_contents(get_stylesheet_directory() . '/images/book-a-demo-icon.svg'); ?><?php _e('Book a Demo', 'lightseek'); ?><?php echo file_get_contents(get_stylesheet_directory() . '/images/chevron-right-solid.svg'); ?>
		   </a>
		</div>
	<?php
		return ob_get_clean();
	
}
add_shortcode( 'book_a_demo', 'book_a_demo_shortcode' );
