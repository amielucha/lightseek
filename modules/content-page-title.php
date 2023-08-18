<?php
/**
 * Module displaying title section of pages.
 *
 * @package lightseek
 */
?>

<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

<?php if (!empty($featured_img_url)) : ?>

<header class="page-title" style="background: url(<?php echo $featured_img_url; ?>) no-repeat right top / cover;">
	<div class="container">
		<?php $top_banner_text = get_field('top_banner_text'); 
			  $top_banner_photo_credit = get_field('top_banner_photo_credit');
		?>
		<div class="row">
		   <div class="col-md-12 left-side">
				<h1 class="section-title"><?php the_title(); ?></h1>
				<div class="title-section-content"><?php echo $top_banner_text; ?></div>
			</div>
			<div class="col-md-12">
				<?php $video_id = get_field('video_id'); 
					  $video_still = get_field('video_still');
					  $video_source = get_field('video_source');
 				?>
				<?php if ($video_id) : ?>
					<div class="video-wrap">
						<?php if ($video_source == 'vimeo') {
							echo do_shortcode('[video_lightbox_vimeo5 video_id="' . $video_id . '" width="100%" height= "100%" anchor="'.$video_still.'"]'); 
						} else {
							echo do_shortcode('[video_lightbox_youtube video_id="' . $video_id . '" width="100%" height= "100%" anchor="'.$video_still.'"]'); 
						}?>					
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if ($top_banner_photo_credit) : ?><div class="photo-credit"><?php echo $top_banner_photo_credit; ?></div><?php endif; ?>
</header>

<?php endif; ?>
