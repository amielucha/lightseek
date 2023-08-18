<?php
/**
 * Module displaying content on single posts.
 *
 * @package lightseek
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1>', '</h1>' ); ?>
		<?php if ( is_active_sidebar( 'share-widget' ) ) dynamic_sidebar( 'share-widget' ); ?> 

		<div class="blog-meta"><span class="author"><?php _e('By','lightseek'); ?>&nbsp;<?php the_author(); ?></span><span class="time"><?php the_time('j M Y'); ?></span>
		</div>
	</header>

	<?php 
	if (has_post_thumbnail()) {
		$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
			if ($featured_img_url) { ?>
				<div class="featured-image" style="background: url(<?php echo $featured_img_url; ?>) no-repeat center / auto 100%"></div>
	<?php 	}
	} ?>

	<div class="entry-content">
		<?php the_content() ?>
		<?php lightseek_link_pages() ?>
	</div>

</article>
