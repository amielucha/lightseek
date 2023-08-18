<?php
/**
 * Module displaying testimonial section on front-page.
 *
 * @package lightseek
 */
?>
<section class="front-testimonial">
	<div class="container">
		<div class="row">
           <div class="push-md-4 push-lg-5 col-md-16 col-lg-14">
			<?php
				$args = array(
						'post_type' => 'testimonial',
						'posts_per_page' => 1,
						'meta_query' => array(
							array(
								'key'     => 'featured_testimonial',
								'compare' => '==',
								'value' => '1'
						    ),
						),
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) { ?>
					
					<h1><?php _e('What our clients say about us', 'lightseek'); ?></h1>
				<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<div class="testimonial">
							<h5><?php the_title(); ?></h5>
							<?php $content = get_the_content();
								  $content = '<span>&ldquo;</span>'.$content.'<span>&rdquo;</span>';
								  echo apply_filters('the_content', $content);
							?>
						</div>

					<?php }
					/* Restore original Post Data */
					wp_reset_postdata();
				}

				?>

				<a class="btn btn-primary" href="<?php bloginfo( 'url' ); ?>/testimonials"><?php _e('Read more', 'lightseek'); ?></a>

			</div>
		</div>
	</div>
</section>
