<?php
/**
 * WooCommerce Functions
 *
 * @package baSeek
 */
if ( !class_exists( 'WooCommerce' ) )
  return;

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
