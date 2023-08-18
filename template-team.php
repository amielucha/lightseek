<?php
/**
 * The Team Listing template.
 *
 * TEMPLATE NAME: Team Listing
 * @package lightseek
 */

get_header();

get_template_part( 'modules/content', 'page-title' );

do_action('lightseek_template_start');


?>
	<div class="row">
		<div class="col-md-24">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								
								<h1 class="entry-title"><?php the_title(); ?></a></h1>

							</header>

							<div class="row">
								<div class="col-md-14">

									<div class="entry-content">
										<?php the_content() ?>
									</div>
								</div>
							</div>
						</article>
			
				   <?php endwhile ?>
			<?php endif ?>
		</div>
	</div>

<?php

get_template_part( 'modules/content', 'team-listing' );


do_action('lightseek_template_end');
get_footer();
