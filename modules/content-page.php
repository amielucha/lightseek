<?php
/**
 * Module displaying content on single posts.
 *
 * @package lightseek
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php $booking_online_link = get_field('booking_online_link', 'option'); ?>

		<h1 class="entry-title"><?php the_title(); ?><a class="btn btn-primary" target="_blank" href="<?php echo $booking_online_link; ?>"><?php _e('Online booking', 'lightseek' ); ?></a></h1>

	</header>

	<div class="entry-content">
		<?php the_content() ?>
	</div>
</article>
