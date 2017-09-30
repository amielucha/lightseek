<?php
/*
 * Theme actions
 * This is where you configure common theme elements and inject content into hooks.
 *
 * List of custom theme hooks:
 *
 * * lightseek_homepage_header
 * * lightseek_homepage_content
 * * lightseek_homepage_after_content
 *
 * * lightseek_header_bg
 * * lightseek_header
 *
 * * lightseek_footer_widgets
 * * lightseek_footer_siteinfo
 *
 * * lightseek_template_start
 * * lightseek_template_end
 */

/*
 *
 * Actions
 *
 */

/* Homepage */
//add_action('lightseek_homepage_header', 'lightseek_homepage_header', 10);
add_action('lightseek_homepage_content', 'the_content', 10);
//add_action('lightseek_homepage_content', 'lightseek_homepage_content_text', 50);
add_action('lightseek_homepage_content', 'lightseek_homepage_sections', 50);

/* Header */
add_action('lightseek_header_bg', 'lightseek_header_bg', 10);
add_action('lightseek_header', 'lightseek_site_branding', 10);
add_action('lightseek_header', 'lightseek_primary_nav', 20);
//add_action('lightseek_header', 'lightseek_header_title', 30);

/* Footer */
add_action('lightseek_footer_widgets', 'lightseek_footer_nav', 10);
add_action('lightseek_footer_widgets', 'lightseek_footer_render_widgets', 20);

/* Colophon */
add_action('lightseek_footer_siteinfo', 'lightseek_copyright', 40);
add_action('lightseek_footer_siteinfo', 'lightseek_designed_by', 80);


/*
 * Template opening and closing tags
 */
require_once get_template_directory() . '/inc/template-wrappers.php';
add_action('lightseek_template_start', 'lightseek_template_wrapper_start', 50);
add_action('lightseek_template_end', 'lightseek_template_wrapper_end', 50);

/*
 *
 * Functions
 *
 */
/* Homepage */
function lightseek_homepage_header() {
	echo '<header class="entry-header">';
		lightseek_post_header();
	echo '</header>';
}

function lightseek_homepage_content_text() {
	if ( SeekConfig::FRONT_PAGE_SECTIONS )
		lightseek_front_page_section( null, 1 ); // display first section
}

function lightseek_homepage_sections() {
	if ( SeekConfig::FRONT_PAGE_SECTIONS )
		lightseek_display_all_custom_panels();
}

/* Header */
function lightseek_header_bg() {
	if ( !SeekConfig::ENABLE_CUSTOM_HEADER )
		return;

	echo 'style="background-image: url(' . get_header_image() . ')"';
}

function lightseek_site_branding() {
	?>

	<div class="site-header-inner">
		<div class="container">
			<div class="navbar-header">
				<div class="site-branding" itemscope itemtype="https://schema.org/logo">
					<?php if ( function_exists( 'the_custom_logo' ) ) the_custom_logo() ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php else: ?>
						<p class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<p class="site-description h2"><?php bloginfo( 'description' ); ?></p>
					<?php endif ?>
				</div><!-- .site-branding -->
			</div>
		</div>
	</div>

	<?php
}

function lightseek_primary_nav() {
	?>
	<nav id="site-navigation" class="main-navigation navbar container" role="navigation">
		<label for="menu-toggle" class="menu-toggle-label"><span class="hamburger" aria-hidden="true">&#8801;</span> Menu</label>
		<input type="checkbox" id="menu-toggle" class="menu-toggle invisible" aria-controls="primary-menu" />
		<?php if ( has_nav_menu( 'primary' ) ) wp_nav_menu (
			array (
				'container_class'=> 'nav-menu-container',
				'theme_location' => 'primary',
				'menu_class'     => 'nav navbar-nav',
				'menu_id'		 => 'primary-menu',
				'walker'				 => new iSeek_Menu_Walker()
				)
		) ?>
	</nav><!-- #site-navigation -->
	<?php
}

function lightseek_header_title() {
	// Displays page title depending on the context
	if ( is_front_page() ) {
		echo '<div class="container h2 page-title">' . get_bloginfo( 'description' ) . '</div>' ;
	} elseif ( is_home() ) {
		//
	} elseif ( is_singular() ) {
		the_title( '<h1 class="container page-title">', '</h1>' );
	} elseif ( is_post_type_archive() ) {
		post_type_archive_title('<h1 class="page-title">', '</h1>');
	}
}

/* Footer */
function lightseek_footer_nav() {
	if ( has_nav_menu( 'footer' ) ){
		echo '<div class="main-navigation footer-menu">';
		wp_nav_menu(
			array (
				'theme_location' => 'footer',
				'menu_class'     => 'nav navbar-nav',
				'menu_id'				 => 'footer-menu',
				'walker'				 => new iSeek_Menu_Walker()
			)
		);
		echo '</div>';
	}
}

function lightseek_footer_render_widgets() {
	// Footer Widgets Settings
	// SeekConfig::FOOTER_WIDGETS_COUNT
	$footer_widget_count = 0;

	if (is_active_sidebar( 'footer-widget')) $footer_widget_count++;
	for ($i=2; $i <= SeekConfig::FOOTER_WIDGETS_COUNT; $i++)
		if (is_active_sidebar( 'footer-widget-' . $i )) $footer_widget_count++;

	switch ( $footer_widget_count ) {
		case 1:
			$footer_widget_width = "col-md-24";
			break;
		case 2:
			$footer_widget_width = "col-md-12";
			break;
		case 3:
			$footer_widget_width = "col-md-8";
			break;
		default:
			$footer_widget_width = "col-sm-12 col-md-6";
			break;
	}

	if ( $footer_widget_count != 0 ) {
		echo '<div class="footer-widgets-row row">';
			for ( $i=1; $i <= $footer_widget_count; $i++ ) {
				$sBar = $i === 1 ? 'footer-widget' : 'footer-widget-' . $i;
				if ( is_active_sidebar( $sBar ) )
					echo "<div class='$footer_widget_width' id='footer_" . $i . "'>"; dynamic_sidebar( $sBar ); echo "</div>";
			}
		echo '</div>';
	}
}

/* Colophon */
function lightseek_copyright() {
	echo '<p>&copy; Copyright '
		. date('Y')
		. ' '
		.  get_bloginfo('name')
		. '. All rights Reserved.</p>';
}

function lightseek_designed_by() {
	printf( __('<a href="%1$s" title="%2$s" target="_blank" class="iseek-link">%3$s ', 'lightseek'), 'http://www.iseek.ie', 'Seek Internet Solutions, Fermoy, Cork, Ireland', 'Website Crafted by ' );
	include get_template_directory() . '/images/iseek-logo.svg';
	echo '</a>';
}
