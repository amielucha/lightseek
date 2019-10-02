<?php

/**
 * lightseek functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lightseek
 */

/**
 * Set up a Lightseek Option global variable.
 */
$lightseek_options = lightseek_get_options();


function lightseek_get_options()
{
	$file = file_get_contents(trailingslashit(get_template_directory()) . 'package.json');

	return json_decode($file, true)['lightseek_options'];
}

function lightseek_get_option($option)
{
	// Access the options global variable.
	$options = !empty($GLOBALS['lightseek_options']) ? $GLOBALS['lightseek_options'] : null;

	return $options && array_key_exists($option, $options) ? $options[$option] : null;
}

if (!function_exists('lightseek_setup')) :
	/** 
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function lightseek_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on lightseek, use a find and replace
		 * to change 'lightseek' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('lightseek', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// Nav menus
		$menusArray = array('primary' => esc_html__('Primary', 'lightseek'));

		lightseek_get_option('footer-menu') &&
			$menusArray['footer'] =  __('Footer Menu', 'lightseek');

		lightseek_get_option('legal-menu') &&
			$menusArray['legal'] =  __('Legal Menu', 'lightseek');

		$menusArray['topbar'] =  __('Top Bar', 'lightseek');

		register_nav_menus($menusArray);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));


		//Custom color palette
		add_theme_support('editor-color-palette', array(
			array(
				'name'  => __('Primary', 'lightseek'),
				'slug'  => 'primary',
				'color'	=> lightseek_get_option('colors')['primary'],
			),
			array(
				'name'  => __('Secondary', 'lightseek'),
				'slug'  => 'secondary',
				'color' => lightseek_get_option('colors')['secondary'],
			),
			array(
				'name'  => __('Dark', 'lightseek'),
				'slug'  => 'dark',
				'color' => lightseek_get_option('colors')['body'],
			),
			array(
				'name'  => __('Transparent', 'lightseek'),
				'slug'  => 'transparent',
				'color' => 'transparent',
			),
			array(
				'name'  => __('Inherit', 'lightseek'),
				'slug'  => 'inherit',
				'color' => 'black',
			),
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('lightseek_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Gutenberg full width
		add_theme_support('align-wide');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text'	=> array('site-title', 'site-description'),
		));
	}
endif;
add_action('after_setup_theme', 'lightseek_setup');

/**
 * Remove WP link from admin
 */
function lightseek_admin_bar_remove_logo()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'lightseek_admin_bar_remove_logo', 0);

/**
 * Load Gutenberg CSS
 */
add_theme_support('editor-styles');
//add_theme_support('dark-editor-style');
add_editor_style('backend.css');
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lightseek_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('lightseek_content_width', 1188);
}
add_action('after_setup_theme', 'lightseek_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lightseek_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'lightseek'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'lightseek'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}

if (lightseek_get_option('widgets'))
	add_action('widgets_init', 'lightseek_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function lightseek_scripts()
{
	wp_enqueue_style('lightseek-style', get_stylesheet_uri());

	wp_enqueue_script('lightseek-navigation', get_template_directory_uri() . '/js/navigation.js', array(), null, true);

	wp_enqueue_script('lightseek-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true);

	if (lightseek_get_option('scripts')) {
		$dependencies = array();

		if (lightseek_get_option('fitvids')){
			$dependencies[] = 'fitvids';
			wp_enqueue_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), null, true);
		}

		if (lightseek_get_option('owl')){
			$dependencies[] = 'owl';
			wp_enqueue_script('owl', get_template_directory_uri() . '/js/owl-carousel-2-2.3.4/owl.carousel.js', array('jquery'), null, true);
		}

		wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', $dependencies, null, true);
	}

	/**
	 * Load Font Awesome.
	 * 
	 * Note: the package is configured in FA Kits.
	 */
	if (lightseek_get_option('fontawesome')['enabled']) {
		wp_enqueue_script('fa-kit', 'https://kit.fontawesome.com/2aefe4a781.js', array(), null);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'lightseek_scripts');

// Web Font Loader
// https://github.com/typekit/webfontloader
function lightseek_webfonts_script()
{
	!empty(lightseek_get_option('webfonts')) &&
		wp_enqueue_script('webfont', 'https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js', array(), null);
}

add_action('wp_enqueue_scripts', 'lightseek_webfonts_script');
add_action('admin_enqueue_scripts', 'lightseek_webfonts_script');

/**
 * Defer selected scripts.
 */
function lightseek_add_defer_attribute($tag, $handle)
{
	$tags = array('scripts');
	if (!in_array($handle, $tags)) return $tag;
	return str_replace(' src', ' defer src', $tag);
}
add_filter('script_loader_tag', 'lightseek_add_defer_attribute', 10, 2);


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Backwards compatibility
 */
if (!function_exists('wp_body_open')) {
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
}

/**
 * custom var_dump() function.
 */
if (!function_exists('vd')) {
	function vd($var)
	{
		if (!WP_DEBUG) return;

		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}


/**
 * ACF Options
 */
if (function_exists('acf_add_options_page')) {
	// Options page
	acf_add_options_page();

	// Options page fields
	require_once get_template_directory() . '/inc/acf-site-options.php';
}

function lightseek_add_block_category($categories)
{
	$categories[] = array(
		'slug'  => 'lightseek-blocks',
		'title' => 'Lightseek Blocks'
	);

	return $categories;
}
add_filter('block_categories', 'lightseek_add_block_category');

/**
 * Lightseek template actions.
 */
require get_template_directory() . '/inc/actions.php';
require get_template_directory() . '/inc/actions-project.php';

/**
 * ACF Pro blocks.
 */
require_once get_template_directory() . '/blocks/blocks.php';

/**
 * Load Google WebFonts.
 */
function lightseek_font_script()
{
	?>
	<script>
		WebFont.load({
			google: {
				families: <?php echo '["',
											implode('", "', lightseek_get_option('webfonts')),
											'"]' ?>
			}
		});
	</script>
<?php

}

if (!empty(lightseek_get_option('webfonts')))
	add_action('wp_footer', 'lightseek_font_script', 0);

/**
 * Gutenberg scripts and styles
 * @see https://www.billerickson.net/block-styles-in-gutenberg/
 */
function lightseek_gutenberg_scripts()
{

	wp_enqueue_script(
		'lightseek-editor',
		get_stylesheet_directory_uri() . '/js/editor.js',
		array('wp-blocks', 'wp-dom'),
		filemtime(get_stylesheet_directory() . '/js/editor.js'),
		true
	);
}
add_action('enqueue_block_editor_assets', 'lightseek_gutenberg_scripts');


/**
 * Menu toggle script.
 */
function lightseek_mobile_nav_toggle()
{
	?>
	<script>
		document.getElementById('primary-menu').addEventListener('click', function(event) {
			if (event.target == this) {
				event.preventDefault();
				document.getElementById('site-navigation').classList.remove('toggled');
			}
		});
	</script>
<?php
}
add_action('wp_footer', 'lightseek_mobile_nav_toggle');


// Renders social media icons
// Styles can be square or default
function lightseek_social($square = false)
{
	// Bail early if no ACF.
	if (!function_exists('get_field')) return;

	$social = get_field('social_media', 'options');
	$facebook = $social['facebook'];
	$twitter = $social['twitter'];
	$instagram = $social['instagram'];
	$linkedin = $social['linkedin'];
	$youtube = $social['youtube'];

	?>
	<div class="social" style="text-align: center">
		<?php if ($facebook) : ?>
			<a href="<?= $facebook ?>" target="_blank" rel="noreferrer noopener">
				<i class="fab <?= $square ? 'fa-facebook-square' : 'fa-facebook-f' ?>"></i>
			</a>
		<?php endif ?>
		<?php if ($instagram) : ?>
			<a href="<?= $instagram ?>" target="_blank" rel="noreferrer noopener">
				<i class="fab fa-instagram"></i>
			</a>
		<?php endif ?>
		<?php if ($twitter) : ?>
			<a href="<?= $twitter ?>" target="_blank" rel="noreferrer noopener">
				<i class="fab <?= $square ? 'fa-twitter-square' : 'fa-twitter' ?>"></i>
			</a>
		<?php endif ?>
		<?php if ($linkedin) : ?>
			<a href="<?= $linkedin ?>" target="_blank" rel="noreferrer noopener">
				<i class="fab <?= $square ? 'fa-linkedin-square' : 'fa-linkedin-in' ?>"></i>
			</a>
		<?php endif ?>
		<?php if ($youtube) : ?>
			<a href="<?= $youtube ?>" target="_blank" rel="noreferrer noopener">
				<i class="fab <?= $square ? 'fa-youtube-square' : 'fa-youtube' ?>"></i>
			</a>
		<?php endif ?>
	</div>
<?php
}

// Adjust the font size list
function lightseek_custom_font_sizes()
{
	// removes the text box where users can enter custom pixel sizes
	add_theme_support('disable-custom-font-sizes');
	// forces the dropdown for font sizes to only contain "normal"
	add_theme_support('editor-font-sizes', array(
		array(
			'name' => 'Normal',
			'size' => 16,
			'slug' => 'normal'
		),
		array(
			'name' => 'Large',
			'size' => 20,
			'slug' => 'large'
		),
	));
}
//add_action('after_setup_theme', 'lightseek_custom_font_sizes');

function lightseek_excerpt_length($length)
{
	return 120;
}
add_filter('excerpt_length', 'lightseek_excerpt_length', 999);
