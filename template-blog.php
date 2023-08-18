<?php
/**
 * The Blog Listing template.
 *
 *  TEMPLATE NAME: Blog Listing
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start');

get_template_part( 'modules/content', 'page-title' );

?>
	<div class="row">
		<div class="col-md-24">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'modules/content', 'page-no-booking' ) ?>
					<?php endwhile ?>
			<?php endif ?>
		</div>
	</div>


	<div class="blog-listing">


			<?php
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

				$args = array(
						'post_type' => 'post',
						'paged' => $paged,
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) { ?>
				
				<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<div class="blog-post">
							<h6><?php the_title(); ?></h6>
							<div class="blog-meta"><span class="author"><?php _e('By','lightseek'); ?>&nbsp;<?php the_author(); ?></span><span class="time"><?php the_time('j M Y'); ?></span></div>
							<div class="blog-post-excerpt">
								<div class="row">
									<div class="col-md-10">
										<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); ?>
											<div class="blog-img" style="background: url(<?php echo $featured_img_url; ?>) no-repeat center / cover"></div>
									</div>
									<div class="col-md-14">
										<?php the_excerpt(); ?>
										<a class="chevron" href="<?php the_permalink(); ?>">Read More</a>
									</div>
								</div>
							</div>	
						</div>


					<?php }

				     wp_pagenavi(array('query' => $the_query));

					/* Restore original Post Data */
					wp_reset_postdata();
				}
				
			?>

	</div>

<?php
do_action('lightseek_template_end');
get_footer();
