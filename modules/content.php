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

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php if ( function_exists('time_ago') ) time_ago(); ?>
		</div><!-- .entry-meta -->
		<?php endif ?>
		<?php //if ( has_post_thumbnail() ) echo '<div class="post-cover"><a href="' . esc_url( get_permalink() ) . '" title="' . get_the_title() .  '">' . get_the_post_thumbnail() . '</a></div>' ?>
		<?php if ( has_post_thumbnail() ) echo '<a class="post-cover alignright" href="' . esc_url( get_permalink() ) . '" title="' . get_the_title() .  '">' . get_the_post_thumbnail(null, 'thumbnail') . '</a>' ?>
	</header>

	<div class="entry-content">
		<?php
			the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', '_lightseek' ), array( 'span' => array( 'class' => array() ) ) ) );
		?>

		<?php
			lightseek_link_pages();
		?>
	</div><!-- .entry-content -->

</article>
