<?php
/**
 * The main template file.
 *
 * @package lightseek
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">
		<?php if ( have_posts() ) : ?>

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

		</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
