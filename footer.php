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
				<?php do_action('lightseek_footer_siteinfo') ?>
			</div><!-- .site-info -->
		</div><!-- #colophon -->
	</div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
