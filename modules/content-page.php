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

		<?php get_template_part( 'modules/module', 'cover' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content() ?>
	</div>
</article>
