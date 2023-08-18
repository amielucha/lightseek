<?php
/**
 * Module displaying news section on front-page.
 *
 * @package lightseek
 */
?>
<section class="front-news">
	<div class="container">
			<?php
				$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) { ?>
					
					<h1 class="section-title"><?php _e('Latest Blog Posts', 'lightseek'); ?></h1>

					<?php function ams_excerpt_length( $length ) {
 										return 10;
						  }
						  add_filter( 'excerpt_length', 'ams_excerpt_length' );

						  function ams_excerpt_more() {
						       return '';
						  }  
						  add_filter('excerpt_more', 'ams_excerpt_more');


						  ?>

			<div class="row">

				<?php
					while ( $the_query->have_posts() ) {
						  $the_query->the_post();
						  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
						  $date = get_the_time('jS');
						  $month =  get_the_time('M');

						?>
						<div class="col-md-8">
						  <a href="<?php the_permalink(); ?>">	
							<div class="news">
								<div class="news-image" style="background: url(<?php echo $featured_img_url; ?>) no-repeat center / cover;"><div class="date"><?php echo $date . '<br />' . $month; ?></div></div>
								<h6><?php the_title(); ?></h6>
									<div><?php the_excerpt(); ?><i class="material-icons">chevron_right</i></div>
							</div>
						  </a>
						</div>

					<?php }
					/* Restore original Post Data */
					wp_reset_postdata(); ?>
					<?php remove_filter( 'excerpt_length', 'ams_excerpt_length' ); 
					      remove_filter('excerpt_more', 'ams_excerpt_more');  ?>

			</div>

			  <a class="btn btn-primary" href="<?php bloginfo( 'url' ); ?>/blog"><?php _e('Read more', 'lightseek'); ?></a>

			<?php	}

				?>

	</div>
</section>
