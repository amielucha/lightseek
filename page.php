<?php
/**
 * The Page template.
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start');
?>
	<div class="row">
		<?php echo ( SeekConfig::SIDEBAR_ON_PAGES && SeekConfig::SIDEBAR && is_active_sidebar('sidebar') ) ? '<div class="col-24 col-md-' . ( 24 - SeekConfig::SIDEBAR_W ) . '">' : '<div class="push-md-2 push-lg-3 col-24 col-md-20 col-lg-18">' ?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'modules/content', 'page' ) ?>
					<?php endwhile ?>
			<?php endif ?>
		<?php echo '</div>'; // closing the conditional tag ?>
		<?php if ( SeekConfig::SIDEBAR_ON_PAGES && SeekConfig::SIDEBAR && is_active_sidebar('sidebar') ) get_sidebar() ?>
	</div>

<?php
do_action('lightseek_template_end');
get_footer();
