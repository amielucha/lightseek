<?php
/**
 * Module displaying content on single posts.
 *
 * @package lightseek
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php if ( function_exists('time_ago') ) time_ago(); ?>
		</div><!-- .entry-meta -->

		<?php get_template_part( 'modules/module', 'cover' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content() ?>
		<?php lightseek_link_pages() ?>
	</div>

	<footer class="entry-footer">
		<?php if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $categories_list );
			}
		} ?>
	</footer>
</article>
