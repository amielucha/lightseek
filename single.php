<?php
/**
 * Single post template.
 *
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start');
?>
	<div class="row">
		<?php echo ( SeekConfig::SIDEBAR && is_active_sidebar('sidebar') ) ? '<div class="col-24 col-md-' . ( 24 - SeekConfig::SIDEBAR_W ) . '">' : '<div class="col-24 col-md-24">' ?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'modules/content', 'single' ) ?>

						<?php lightseek_post_navigation() ?>

						<?php if ( comments_open() || get_comments_number() ) comments_template()	?>

					<?php endwhile ?>
			<?php endif ?>
		<?php echo '</div>'; // closing the conditional tag ?>
		<?php if ( SeekConfig::SIDEBAR && is_active_sidebar('sidebar') ) get_sidebar() ?>
	</div>

<?php
do_action('lightseek_template_end');
get_footer();
