<?php
/**
 * The theme footer.
 *
 * @package lightseek
 */
?>
		</div><!-- #content -->
	</div><!-- #page -->
</div><!-- #page-wrapper -->

<footer class="footer-wrapper">

	<div class="footer-widgets-wrapper">
		<div class="footer-widgets-container container">
			<?php do_action('lightseek_footer_widgets') ?>
		</div>
	</div>
	<div class="colophon-wrapper">
		<div id="colophon" class="site-footer container text-center" role="contentinfo">
			<div class="site-info">
				<?php $twitter = get_field('twitter', 'option'); 
					  $instagram = get_field('instagram', 'option'); 
					  $linkedin = get_field('linkedin', 'option'); 
					  $facebook = get_field('facebook', 'option'); 
				?>
				<p><?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?><span class="bar">&vert;</span><a href="<?php bloginfo( 'url' ); ?>/privacy-policy/"><?php _e( 'Privacy Policy', 'lightseek' ); ?></a><span class="bar">&vert;</span>Websites by <a href="https://iseek.ie">iSeek</a></p>
				<span class="social-span"><?php if (!empty($twitter)) { ?> <a class="social fa fa-twitter" href="<?php echo $twitter; ?>" title="Follow us on Twitter" target="_blank"></a><?php } ?><?php if (!empty($instagram)) { ?> <a class="social fa fa-instagram" href="<?php echo $instagram; ?>" title="Follow us on Instagram" target="_blank"></a><?php } ?><?php if (!empty($linkedin)) { ?> <a class="social fa fa-linkedin" href="<?php echo $linkedin; ?>" title="Follow us on LinkedIn" target="_blank"></a><?php } ?><?php if (!empty($facebook)) { ?> <a class="social fa fa-facebook" href="<?php echo $facebook; ?>" title="Follow us on Facebook" target="_blank"></a><?php } ?></span>
			</div><!-- .site-info -->
		</div><!-- #colophon -->
	</div>

</footer>
<?php wp_footer();
