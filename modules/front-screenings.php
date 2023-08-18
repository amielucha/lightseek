<?php
/**
 * Module displaying screenings section on front-page.
 *
 * @package lightseek
 */
?>
<section class="front-screenings">
	<div class="container">
		<?php $health_screening_boxes_intro_title = get_field('health_screening_boxes_intro_title'); 
			  $health_screening_boxes_intro = get_field('health_screening_boxes_intro'); 
		?>		

	<?php if( have_rows('health_screening_boxes') ): ?>
 
    	<div class="row">
    		<div class="col-md-24">
    			<h1 class="section-title"><?php echo $health_screening_boxes_intro_title; ?></h1>
    			<div class="section-content"><?php echo $health_screening_boxes_intro; ?></div>
    		</div>
        </div>    
        <div class="row">
    <?php while( have_rows('health_screening_boxes') ): the_row(); ?>
    		<?php   $box_title = get_sub_field('box_title');
    				$box_content = get_sub_field('box_content');
    				$read_more_link = get_sub_field('read_more_link'); 
    		?>

    		<div class="col-md-8">
				<div class="screening-box">
					<h5><?php echo $box_title; ?></h5>
					<div class="screening-box-content"><?php echo $box_content; ?></div>
					<div class="screening-link"><a class="chevron" href="<?php echo $read_more_link; ?>">Read More</a></div>
				</div> 
			</div>
        
      
    <?php endwhile; ?>
 
    </div>
 
<?php endif; ?>


	</div>
</section>
