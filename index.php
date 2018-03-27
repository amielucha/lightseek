<?php
/**
 * The main template file.
 *
 * @package lightseek
 */
defined('ABSPATH') or die("These Are Not the Droids You Are Looking For");

get_header();
do_action('lightseek_template_start', 'container'); // Use 'container', 'container-fluid', or custom class.);
?>
	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				get_template_part( 'modules/content', get_post_format() );
			?>

		<?php endwhile; ?>

		<?php lightseek_posts_navigation() ?>

	<?php else : ?>

		<?php get_template_part( 'modules/content', 'none' ); ?>

	<?php endif; ?>

<?php
do_action('lightseek_template_end');
get_footer();
