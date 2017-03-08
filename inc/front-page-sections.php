<?php
add_filter( 'lightseek_front_page_sections', 'lightseek_custom_front_sections' );
function lightseek_custom_front_sections( $num_sections ) {
	return SeekConfig::FRONT_PAGE_SECTIONS; //Change this number to change the number of the sections.
}

/**
 * Display a front page section.
 *
 * @param $partial WP_Customize_Partial Partial associated with a selective refresh request.
 * @param $id integer Front page section to display.
 */
function lightseek_front_page_section( $partial = null, $id = 0, $template_name = 'front-page-panels' ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		// Find out the id and set it up during a selective refresh.
		global $lightseekcounter;
		$id = str_replace( 'panel_', '', $partial->id );
		$lightseekcounter = $id;
	}

	global $post; // Modify the global post object before setting up post data.
	if ( get_theme_mod( 'panel_' . $id ) ) {
		global $post;
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

		get_template_part( 'modules/content', $template_name );

		wp_reset_postdata();
		//var_dump($post);
	} elseif ( is_customize_preview() ) {
		// The output placeholder anchor.
		echo '<article class="panel-placeholder panel lightseek-panel lightseek-panel' . $id . '" id="panel' . $id . '"><span class="lightseek-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 'lightseek' ), $id ) . '</span></article>';
	}
}

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function lightseek_panel_count() {

	$panel_count = 0;

	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'lightseek_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		if ( get_theme_mod( 'panel_' . $i ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

function lightseek_display_all_custom_panels() {
	// Get each of our panels and show the post data.
	if ( SeekConfig::FRONT_PAGE_SECTIONS ) :
		if ( 0 !== lightseek_panel_count() || is_customize_preview() ) : // If we have pages to show.

			/**
			 * Filter number of front page sections in Lightseek.
			 *
			 * @param $num_sections integer
			 */
			$num_sections = apply_filters( 'lightseek_front_page_sections', 4 );
			global $lightseekcounter;

			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$lightseekcounter = $i;
				lightseek_front_page_section( null, $i );
			}
		endif; // The if ( 0 !== lightseek_panel_count() ) ends here.
	endif;
}

function lightseek_customize_register( $wp_customize ) {
	/**
	 * Filter number of front page sections in Twenty Seventeen.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $num_sections integer
	 */
	$num_sections = apply_filters( 'lightseek_front_page_sections', 4 );

	$wp_customize->add_section( 'theme_options', array(
		'title'    => __( 'Home Sections', 'lightseek' ),
		'priority' => 130, // Before Additional CSS.
	) );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'lightseek' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'lightseek' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'lightseek_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'lightseek_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'lightseek_customize_register' );

function lightseek_is_static_front_page() {
	return ( is_front_page() || is_home() );
}
