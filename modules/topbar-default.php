<?php
// Top Bar Module
?>
	<aside class="top-bar text-right">
		<div class="container top-bar-container">
			<?php dynamic_sidebar( 'topbar' ); ?>
			<?php if ( class_exists( 'WooCommerce' ) ){
				global $woocommerce;
				echo '<a class="cart-btn" href="' . $woocommerce->cart->get_cart_url() . '" title="' . __( 'Shopping Cart' ) . '">' . __( '<span class="sr-only">Cart</span><span class="fas fa-shopping-cart" aria-hidden="true"></span>' ) . '</a>';
			}
			?>
		</div>
	</aside>
