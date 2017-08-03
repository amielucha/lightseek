<?php
/**
 * The main template file.
 *
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start');
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
				get_template_part( 'modules/content', 'search' );
			?>

		<?php endwhile; ?>

		<?php lightseek_posts_navigation() ?>

	<?php else : ?>

		<?php get_template_part( 'modules/content', 'none' ); ?>

	<?php endif; ?>

<?php
do_action('lightseek_template_end');
get_footer();
