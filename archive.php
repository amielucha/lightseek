<?php
/**
 * The main template file.
 *
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start');

	if ( have_posts() ){

		while ( have_posts() ){
			the_post();
			get_template_part( 'modules/content', get_post_format() );
		}

		lightseek_posts_navigation();

	} else {
		get_template_part( 'modules/content', 'none' );
	}

do_action('lightseek_template_end');
get_footer();
