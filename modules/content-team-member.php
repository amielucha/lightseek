<?php
/**
 * Module displaying content on single posts.
 *
 * @package lightseek
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php 	
			$member_title = get_post_meta(get_the_ID(), 'team_member_title', true);
			$member_degrees = get_post_meta(get_the_ID(), 'team_member_degrees', true);
		?>

		<h1 class="entry-title"><?php the_title(); ?><?php echo ($member_degrees) ? '&nbsp;&ndash;&nbsp' . $member_degrees : ''; ?><?php echo ($member_title) ? '&nbsp;&ndash;&nbsp' . $member_title : ''; ?></h1>

	</header>

	<?php

		if (has_post_thumbnail()) {
			$member_img = get_the_post_thumbnail_url(get_the_ID(),'full'); 
		} else {
			$member_img = get_template_directory_uri() . '/images/profile_empty_state.png';
		}
	?>

	<div class="member-image" style="background: url(<?php echo $member_img; ?>) no-repeat center center / cover;"></div>

	<div class="entry-content">
		<?php the_content() ?>
	</div>
</article>
