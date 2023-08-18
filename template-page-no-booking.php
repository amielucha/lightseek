<?php
/**
 * The Page template.
 *
 *  TEMPLATE NAME: Page With No Booking Button
 * @package lightseek
 */

get_header();

get_template_part( 'modules/content', 'page-title' );

do_action('lightseek_template_start');


?>
	<div class="row">
		<div class="col-md-24">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'modules/content', 'page-no-booking' ) ?>
					<?php endwhile ?>
			<?php endif ?>
		</div>
	</div>

<?php
do_action('lightseek_template_end');
get_footer();
