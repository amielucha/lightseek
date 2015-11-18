<?php
/**
 * Module displaying content on single posts.
 *
 * @package lightseek
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php if ( function_exists('time_ago') ) time_ago(); ?>
			</div><!-- .entry-meta -->
		<?php endif ?>
	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
</article>
