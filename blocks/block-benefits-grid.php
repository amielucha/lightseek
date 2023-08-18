<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_benefits_grid_block'); // 1. rename all instances of this and callback functions.
function lightseek_benefits_grid_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'benefits_grid', 
      'title' => __('Box Grid'),  
      'description' => __('Creates grid of 5 boxes.'), 
      'render_callback' => 'lightseek_benefits_grid_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'grid-view',  
      'keywords' => array('grid', 'boxes', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
    ));
  }
}

function lightseek_benefits_grid_callback($block)
{
 
    $boxes = get_field('boxes');

?>

<div class="box-grid-wrapper">
    <?php foreach ($boxes as $box) : 
                 ?>
            <div class="box">
                <img src="<?php echo $box['icon']; ?>" />
                <div class="title"><?php echo $box['title']; ?></div>
                <div class="content"><?php echo $box['content']; ?></div>
            </div>
   <?php endforeach; ?>
</div>

<?php
}

