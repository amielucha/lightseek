<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_two_column_bullets_block'); // 1. rename all instances of this and callback functions.
function lightseek_two_column_bullets_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'two_column_bullets', 
      'title' => __('Two Column Bullets Block'),  
      'description' => __('Creates two columns of stylised bullet points.'), 
      'render_callback' => 'lightseek_two_column_bullets_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'editor-ul',  
      'keywords' => array('column', 'bullet point', 'two', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
    ));
  }
}

function lightseek_two_column_bullets_callback($block)
{
 
    $left_column = get_field('left_column');
    $right_column = get_field('right_column');

?>

<div class="two-column-bullets-wrapper">
        <div class="column left-column">
            <ul>
                <?php foreach($left_column['points'] as $point) : ?>
                    <li><?php echo $point['text']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="column right-column">
            <ul>
                <?php foreach($right_column['points'] as $point) : ?>
                    <li><?php echo $point['text']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
</div>

<?php
}

