<?php
/**
 * The theme footer.
 *
 * @package lightseek
 */

// Footer Widgets Settings
// SeekConfig::FOOTER_WIDGETS_COUNT


$footer_widget_count = 0;
if (is_active_sidebar( 'footer-widget')) $footer_widget_count++;
for ($i=2; $i <= SeekConfig::FOOTER_WIDGETS_COUNT; $i++)
	if (is_active_sidebar( 'footer-widget-' . $i )) $footer_widget_count++;

switch ( $footer_widget_count ) {
	case 1:
		$footer_widget_width = "col-md-24";
		break;
	case 2:
		$footer_widget_width = "col-md-12";
		break;
	case 3:
		$footer_widget_width = "col-md-8";
		break;
	default:
		$footer_widget_width = "col-sm-12 col-md-6";
		break;
}
?>
		</div><!-- #content -->
	</div><!-- #page -->
</div><!-- #page-wrapper -->

<footer class="footer-wrapper">

	<div class="footer-widgets-wrapper">
		<div class="footer-widgets-container container">
			<div class="footer-widgets-row row">
				<?php if ( $footer_widget_count != 0 ){
					for ( $i=1; $i <= $footer_widget_count; $i++ ) {
						$sBar = $i === 1 ? 'footer-widget' : 'footer-widget-' . $i;
						if ( is_active_sidebar( $sBar ) )
							echo "<div class='$footer_widget_width' id='footer_" . $i . "'>"; dynamic_sidebar( $sBar ); echo "</div>";
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="colophon-wrapper">
		<div id="colophon" class="site-footer container" role="contentinfo">
			<div class="site-info">
				<p>&copy; Copyright <?php echo date('Y') ?> <?php bloginfo('name'); ?>. All rights Reserved.</p>
				<?php printf( __('<a href="%1$s" title="%2$s" target="_blank" class="iseek-link">%3$s <span id="iseek-replace" class="iseek-replace">iSeek.ie</span></a>', 'baseek'), 'http://www.iseek.ie', 'Seek Internet Solutions, Fermoy, Cork, Ireland', 'Website Crafted by ' ); ?>
			</div><!-- .site-info -->
		</div><!-- #colophon -->
	</div>

</footer>
<?php wp_footer();
