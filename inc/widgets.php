<?php
function lightseek_widgets_init() {

	if ( SeekConfig::SIDEBAR )
		register_sidebar( array(
			'name' => __( 'Sidebar', 'baseek' ),
			'id' => 'sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	
	if ( SeekConfig::TOPBAR )
		register_sidebar( array(
			'name' => __( 'Top Bar', 'baseek' ),
			'id' => 'topbar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );

	if ( class_exists( 'WooCommerce' ) )
		register_sidebar( array(
			'name' => __( 'Shop Sidebar', 'baseek' ),
			'id' => 'sidebar-shop',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );

	register_sidebars(
		SeekConfig::FOOTER_WIDGETS_COUNT,
		array(
			'name' => __( SeekConfig::FOOTER_WIDGETS_COUNT == 1 ? 'Footer Widget' : 'Footer Widget %d', 'baseek' ),
			'id' => 'footer-widget',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		)
	);
}
add_action( 'widgets_init', 'lightseek_widgets_init' );
