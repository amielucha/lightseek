<?php
/**
 * The Contact Us template.
 *
 * TEMPLATE NAME: Contact Us
 * @package lightseek
 */

get_header();

?>
<div id="primary" class="content-area">
   <main id="main" class="site-main" role="main">
       <div class="container">
<?php
get_template_part( 'modules/content', 'page-title' );

?>
			<div class="row">
				<div class="col-md-24">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header class="entry-header">
									<h1 class="entry-title"><?php the_title(); ?></h1>
								</header>

								<div class="entry-content">
									<?php the_content() ?>
								</div>
						</article>

							<?php endwhile ?>
					<?php endif ?>
				</div>
				<div class="col-md-24">
					<div class="contact-form">
						<?php echo do_shortcode('[gravityform id="1"]'); ?>
					</div>
				</div>
			</div>
		</div>
	   <div class="map">
          <div class="container">
	   	     <h2 class="map_title"><?php _e( 'Location', 'lightseek' ); ?></h2>
	   	 </div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2461.7934827316726!2d-8.358515572365151!3d51.901232799009875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xabb76f87f21d1280!2sAdvanced+Medical+Services!5e0!3m2!1sen!2sie!4v1510584435226" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
	   </div>			
	</main>
</div>

<?php
get_footer();
