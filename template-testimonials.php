<?php
/**
 * The Testimonial Listing template.
 *
 *  TEMPLATE NAME: Testimonial Listing
 * @package lightseek
 */

get_header();
do_action('lightseek_template_start');

get_template_part( 'modules/content', 'page-title' );

?>
	<div class="row">
		<div class="col-md-24">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<?php
				$args = array(
						'post_type' => 'testimonial',
						'posts_per_page' => -1,
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) { ?>
				
				<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						?>
						<div class="testimonial-listing">
							<blockquote>
							<?php $content = get_the_content();
								  $content = '<span>&ldquo;</span>'.$content.'<span>&rdquo;</span>';
								  echo apply_filters('the_content', $content);
							?>
							<p class="source">-&nbsp;<?php the_title(); ?></p>
							</blockquote>
						</div>

					<?php }
					/* Restore original Post Data */
					wp_reset_postdata();
				}

				?>
			</article>
		</div>
	</div>

<?php
do_action('lightseek_template_end');
get_footer();
