<?php
/**
 * WooCommerce template
 *
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start', 'container'); // Use 'container', 'container-fluid', or custom class.);
?>
	<?php woocommerce_content(); ?>
<?php
do_action('lightseek_template_end');
get_footer();
