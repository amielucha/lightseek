<?php
/**
 * Module displaying team listing.
 *
 * @package lightseek
 */
?>
	<div class="row">
		<div class="col-md-24">
			<div class="team-listing">
				<h2><?php _e('Our People', 'lightseek'); ?></h2>
				<div class="team-panels">

					<?php $terms = get_terms( 'team-member-type', array(
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
												'post_type' => 'team-member',
												'posts_per_page' => -1,
												'tax_query' => array(
													array(
														'taxonomy' => 'team-member-type',
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

								   	<div class="row">
									
									<?php
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
						    				$member_name = get_the_title();
						    				$member_title = get_post_meta(get_the_ID(), 'team_member_title', true);
						    				$member_degrees = get_post_meta(get_the_ID(), 'team_member_degrees', true);
						    				if (has_post_thumbnail()) {
						    					$member_img = get_the_post_thumbnail_url(get_the_ID(),'full'); 
						    				} else {
						    					$member_img = get_template_directory_uri() . '/images/profile_empty_state.png';
						    				}
							   		?>

								    		<div class="col-md-8">
												<div class="member-box">
													<h5><?php echo $member_name; ?></h5>
													<div class="member-image" style="background: url(<?php echo $member_img; ?>) no-repeat center center / cover;"></div>
													<h6 class="member-title"><?php echo $member_title; ?></h6>
													<h6 class="member-degrees"><?php echo $member_degrees; ?></h6>
													<a class="chevron" href="<?php echo get_the_permalink(); ?>">Read More</a>
												</div> 
											</div>
										<?php 
												} ?>
										</div>


									<?php } 
									$i++;
									?>
								</div>

					   <?php } ?>
					  </div>
				</div>
			</div>
		</div>
	</div>
