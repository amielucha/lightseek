<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_example_block'); // 1. rename all instances of this and callback functions.
function lightseek_example_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'example', // 2. Set a slug.
      'title' => __('Example'), // 3. Set a title.
      'description' => __('Example block.'), // 4. Add description.
      'render_callback' => 'lightseek_example_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'admin-users', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('example', 'lightseek', 'iseek'), // 6. Add keywords.
    ));
  }
}

function lightseek_example_callback($block)
{
  // 7. Load and the ACF fields.
  $example_field = get_field('example_field');
  ?>
  <section class="section--example align<?= $block['align'] ?> <?= isset($block['className']) ? $block['className'] : '' ?>">
    <p>Value: <?= $example_field ?></p>
  </section>
<?php
}

// 8. Don't forget to require this file in blocks.php.
// 9. Consider adding the ACF field definitions to the file if packaging for reuse.
