<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package baSeek
 */

if ( ! is_active_sidebar( 'sidebar' ) ) return;
?>
<div id="secondary" class="widget-area col-md-<?php echo SeekConfig::SIDEBAR_W ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</div><!-- #secondary -->
