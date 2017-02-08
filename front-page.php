<?php
/**
 * The main template file.
 *
 * @package lightseek
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
			<?php do_action('lightseek_homepage_header') ?>

			<div class="entry-content">
				<?php do_action('lightseek_homepage_content') ?>
			</div>
		</article>
		<?php do_action('lightseek_homepage_after_content') ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
