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
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'modules/content', 'page' ); ?>
				<?php endwhile ?>
		<?php endif ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
