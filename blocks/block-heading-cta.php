<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_headingcta_block'); // 1. rename all instances of this and callback functions.
function lightseek_headingcta_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'headingcta', // 2. Set a slug.
      'title' => __('Heading with CTA'), // 3. Set a title.
      'description' => __('Adds an h2 heading with a call to action button.'), // 4. Add description.
      'render_callback' => 'lightseek_headingcta_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'button', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('cta', 'heading', 'lightseek', 'iseek'), // 6. Add keywords.
      'mode'              => 'auto',
    ));
  }
}

function lightseek_headingcta_callback($block)
{
 
    $heading = get_field('heading');
    $button = get_field('button');

  ?>


<h2 class="heading-cta"><?php echo $heading; ?><a class="btn btn-primary" target="_blank" href="<?php echo $button['link']; ?>"><?php echo $button['label']; ?></a></h2>

<?php
}

