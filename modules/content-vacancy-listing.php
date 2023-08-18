<?php
/**
 * Module displaying vacancy listing.
 *
 * @package lightseek
 */
?>
	<div class="row">
		<div class="col-md-24">
			<div class="team-listing">
				<h2><?php _e('Current Opportunities', 'lightseek'); ?></h2>
				<div class="vacancy-panels">

					<?php $terms = get_terms( 'vacancy-area', array(
									    'hide_empty' => false,
									) );

						  $member_types = array();

						  foreach ($terms as $term) {
						  	  $member_types[] = array('name'=>$term->name,'slug'=> $term->slug);
						  }

 			  			 ?>
						<!-- Nav tabs -->
 			  			 <ul class="nav nav-tabs" role="tablist">

 			  			 <?php	
 			  			  $i=0;
						  foreach ($member_types as $type) { ?>
							    <li class="nav-item">
							   		<a class="nav-link <?php echo ($i==0) ? 'active' : ''; ?>" data-toggle="tab" href="#<?php echo $type['slug']; ?>" role="tab"><?php echo $type['name']; ?></a>
							    </li>
							<?php 
								$i++;
								} ?>

							</ul>

						<!-- Tab panes -->
						<div class="tab-content">
						<?php

							$i=0;
							foreach($member_types as $type) { ?>
								<div class="tab-pane <?php echo ($i==0) ? 'active' : ''; ?>" id="<?php echo $type['slug']; ?>" role="tabpanel">
									<?php
										$args = array(
												'post_type' => 'vacancy',
												'posts_per_page' => -1,
												'tax_query' => array(
													array(
														'taxonomy' => 'vacancy-area',
														'field'    => 'slug',
														'terms'    => $type['slug'],
													),										
												),
											);

									// The Query
									$the_query = new WP_Query( $args ); ?>

								   	<?php
									// The Loop
									if ( $the_query->have_posts() ) { ?>

								
									<?php
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
							   		?>

								    		<div class="vacancy">
													<h6><?php the_title(); ?></h6>
													<div class="vacancy-content">
													   <?php the_content(); ?>
													</div>
											</div> 
										<?php 
												} ?>

									<?php } else { 
											$no_vacancy_title = get_field('no_vacancy_title', 'option');
											$no_vacancy_text = get_field('no_vacancy_text', 'option'); ?>

								    		<div class="vacancy no-vacancy">
													<h6><?php echo $no_vacancy_title; ?></h6>
													<div class="vacancy-content">
													   <?php echo $no_vacancy_text; ?>
													</div>
											</div> 
										<?php	

										  }

									$i++;
									?>
								</div>

					   <?php } ?>
					  </div>
				</div>
			</div>
		</div>
	</div>
