<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_homecontent_block'); // 1. rename all instances of this and callback functions.
function lightseek_homecontent_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'homecontent', // 2. Set a slug.
      'title' => __('Home Page Content'), // 3. Set a title.
      'description' => __('Adds content on the home page.'), // 4. Add description.
      'render_callback' => 'lightseek_homecontent_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'email-alt', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('homecontent', 'lightseek', 'iseek'), // 6. Add keywords.
      'mode'              => 'auto',
    ));
  }
}

function lightseek_homecontent_callback($block)
{
 
  ?>
<section class="front-content">
	<div class="container">
			<article>
				<div class="entry-content">
					<?php the_field('content'); ?>
				</div><!-- .entry-content -->
			</article>

			<?php $ams_medical = get_field('ams_medical', 'option'); ?>

	<?php if ($ams_medical) : ?><a class="btn btn-primary" target="_blank" href="<?php echo $ams_medical; ?>"><?php _e('AMS Medical Login', 'lightseek' ); ?></a><?php endif; ?>

	</div>
</section>
<?php
}

// 8. Don't forget to require this file in blocks.php.
// 9. Consider adding the ACF field definitions to the file if packaging for reuse.
