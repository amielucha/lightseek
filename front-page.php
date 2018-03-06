<?php
/**
 * The main template file.
 *
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start', 'container'); // Use 'container', 'container-fluid', or custom class., 'container');
?>

	<?php the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php do_action('lightseek_homepage_header') ?>

		<div class="entry-content">
			<?php do_action('lightseek_homepage_content') ?>
		</div>
	</article>
	<?php do_action('lightseek_homepage_after_content') ?>

<?php
do_action('lightseek_template_end');
get_footer();
