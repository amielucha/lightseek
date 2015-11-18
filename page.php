<?php
/**
 * The Page template.
 * @package lightseek
 */

get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main container" role="main">
		<div class="row">
			<?php echo ( SeekConfig::SIDEBAR && is_active_sidebar('sidebar') ) ? '<div class="col-md-' . ( 24 - SeekConfig::SIDEBAR_W ) . '">' : '<div class="col-md-24">' ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'modules/content', 'page' ) ?>
						<?php endwhile ?>
				<?php endif ?>
			<?php echo '</div>'; // closing the conditional tag ?>
			<?php if ( SeekConfig::SIDEBAR && is_active_sidebar('sidebar') ) get_sidebar() ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
