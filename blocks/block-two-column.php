<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_two_column_block'); // 1. rename all instances of this and callback functions.
function lightseek_two_column_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'two_column', 
      'title' => __('Two Column Image Text Block'),  
      'description' => __('Creates grid of 5 boxes.'), 
      'render_callback' => 'lightseek_two_column_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'grid-view',  
      'keywords' => array('column', 'image', 'two', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
    ));
  }
}

function lightseek_two_column_callback($block)
{
 
    $title = get_field('title');
    $content = get_field('content');
    $image = get_field('image');
    $image_position = get_field('image_position');

?>

<div class="two-column-wrapper">
        <div class="column content-column <?php echo ($image_position=='right') ? 'first' : 'second'; ?>">
            <h2 class="title"><?php echo $title; ?></h2>
            <div class="content">
                <?php echo $content; ?>
            </div>


        </div>
        <div class="column image-column <?php echo ($image_position=='right') ? 'second' : 'first'; ?>">
            <img class="image" src="<?php echo $image; ?>" />
        </div>
</div>

<?php
}

