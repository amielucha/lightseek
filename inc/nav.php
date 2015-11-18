<?php

/**
 * Add Bootstrap nav item class
 */
function iseek_nav_item_classes( $classes, $item ) {
    $classes[] = 'nav-item';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'iseek_nav_item_classes', 10, 2 );

/**
 * Add Bootstrap menu classes
 */
class iSeek_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=array(), $id=0) {
		global $wp_query;

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '';
		$append = '';
		$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

		if($depth != 0)
			$description = $append = $prepend = "";

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .' class="nav-link">';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
  }
}

/*
 * Fix the current_page_parent bug that highlighted Blog Archive when viewing Custom Post Type
 */
function lightseek_is_blog(){
	global $post;
	$posttype = get_post_type( $post );
	return ( ( $posttype == 'post' ) && ( is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author() ) ) ? true : false;
}

function lightseek_custom_type_class($classes, $item) {

    if ( !lightseek_is_blog() ){
      $blog_page_id = intval( get_option('page_for_posts') );

			if( $blog_page_id != 0 && $item->object_id == $blog_page_id )
				unset($classes[array_search('current_page_parent', $classes)]);
		}
		return $classes;
}
add_filter('nav_menu_css_class', 'lightseek_custom_type_class', 10, 3 );
