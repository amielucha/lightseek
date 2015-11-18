<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package baSeek
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function baseek_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'baseek_jetpack_setup' );

/*
 * Let Jetpack manage site's logo.
 * Requires Jetpack plugin (http://jetpack.me).
 */
$args = array(
    'header-text' => array(
        'site-title',
        'site-description',
    ),
    'size' => 'full',
);
add_theme_support( 'site-logo', $args );
