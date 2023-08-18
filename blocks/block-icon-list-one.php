<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_icon_list_one_block'); // 1. rename all instances of this and callback functions.
function lightseek_icon_list_one_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'icon_list_one', // 2. Set a slug.
      'title' => __('Icon Grid'), // 3. Set a title.
      'description' => __('Creates a grid of items with corresponding icons.'), // 4. Add description.
      'render_callback' => 'lightseek_icon_list_one_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'editor-ul', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('icon list', 'lightseek', 'iseek'), // 6. Add keywords.
      'mode'              => 'auto',
    ));
  }
}

function lightseek_icon_list_one_callback($block)
{
 
  ?>
<section class="icon-list-one">
       <?php $icon_list_items = get_field('icon_list_items'); ?>
       <div class="icon-list">

       <?php foreach ($icon_list_items as $item) : ?>

          <div class="icon-list-item">
              <img src="<?php echo $item['icon']['sizes']['thumbnail']; ?>" />
              <h6 class="icon-title"><?php echo $item['title']; ?></h6>   
          </div>  
       <?php endforeach; ?>

        </div>

</section>
<?php
}

// 8. Don't forget to require this file in blocks.php.
// 9. Consider adding the ACF field definitions to the file if packaging for reuse.
