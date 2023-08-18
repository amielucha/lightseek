<?php
/**
 * Module displaying content section on front-page.
 *
 * @package lightseek
 */
?>
<section class="front-content">
	<div class="container">
	<?php if ( have_posts() ) : ?>
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</article>
		<?php endwhile; ?>
	<?php endif; ?>

			<?php $ams_medical = get_field('ams_medical', 'option'); ?>

	<?php if ($ams_medical) : ?><a class="btn btn-primary" target="_blank" href="<?php echo $ams_medical; ?>"><?php _e('AMS Medical Login', 'lightseek' ); ?></a><?php endif; ?>

	</div>
</section>
