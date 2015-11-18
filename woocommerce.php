<?php
/**
 * WooCommerce template
 *
 * @package lightseek
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">
		<?php woocommerce_content(); ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
