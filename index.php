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

		</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
