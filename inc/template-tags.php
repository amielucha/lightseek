<?php
function lightseek_posts_navigation() {
	if ( function_exists('wp_pagenavi') )
		wp_pagenavi();
	else
		the_posts_navigation();
}

function lightseek_link_pages() {
	global $post;
	if ( is_single() ){
		if ( function_exists('wp_pagenavi') )
			wp_pagenavi( array( 'type' => 'multipart' ) );

		else
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_lightseek' ),
				'after'  => '</div>',
			) );
	}
}

// remove the css regardless of the plugin settings
function pagenavi_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}
add_action( 'wp_print_styles', 'pagenavi_deregister_styles', 100 );


//customize the PageNavi HTML before it is output
function lightseek_pagination($html) {
  $out = '';

  //wrap a's and span's in li's
  $out = str_replace("<div","",$html);
  $out = str_replace("class='wp-pagenavi'>","",$out);
  $out = str_replace("<a","<li class='page-item'><a",$out);
  $out = str_replace("</a>","</a></li>",$out);
  $out = str_replace("<span","<li class='page-item'><span",$out);
  $out = str_replace("</span>","</span></li>",$out);
  $out = str_replace("</div>","",$out);
  $out = str_replace("<a class=\"","<a class=\"page-link ",$out);
	$out = str_replace("<li class='page-item'><span class='current'>","<li class='disabled page-item'><span class='page-link current'>",$out);
  $out = str_replace("pages","pages page-link",$out);

  return '<nav class="pagination-nav text-center"><ul class="pagination">'.$out.'</ul></nav>';
}
add_filter( 'wp_pagenavi', 'lightseek_pagination', 10, 2 );


// Replace post navigation html
function lightseek_post_navigation( $args = array('prev_text' => '<span class="fa fa-caret-left" aria-hidden="true"></span> %title', 'next_text' => '%title <span class="fa fa-caret-right" aria-hidden="true"></span>' ) ){
	$out = get_the_post_navigation( $args );

	$out = str_replace("<div class=\"nav-links\">","<ul class=\"nav-links pager\">",$out);
	$out = str_replace("</div></div>","</div></ul>",$out);
	$out = str_replace("<div class=\"nav-next\">"," <li class='nav-next pager-next' title='Next Post'>",$out);
	$out = str_replace("<div class=\"nav-previous\">"," <li class='nav-previous pager-prev' title='Previous Post'>",$out);
	$out = str_replace("</div>","",$out);

	echo $out;
}
