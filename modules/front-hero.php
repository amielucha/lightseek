<?php
/**
 * Module displaying hero section on front-page.
 *
 * @package lightseek
 */
?>

<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>

<section class="front-hero" style="background: url(<?php echo $featured_img_url; ?>) no-repeat right top / cover;">
	<div class="container">
		<?php $hero_title = get_field('hero_title'); 
			  $hero_content = get_field('hero_content'); 
			  $hero_button_text = get_field('hero_button_text'); 
			  $hero_button_link = get_field('hero_button_link'); 
		?>
		<h1 class="section-title"><?php echo $hero_title; ?></h1>
		<div class="section-content"><?php echo $hero_content; ?></div>
<?php if ($hero_button_link) : ?><a class="btn btn-primary" target="_blank" href="<?php echo $hero_button_link; ?>"><?php echo $hero_button_text; ?></a><?php endif; ?>
	</div>
</section>
