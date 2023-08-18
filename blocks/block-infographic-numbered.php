<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_infographic_numbered_block'); // 1. rename all instances of this and callback functions.
function lightseek_infographic_numbered_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'infographic_numbered', 
      'title' => __('Infographic with Numbered Steps'),  
      'description' => __('Creates a Numbered stepped info graphic with arrows between each step, max 6.'), 
      'render_callback' => 'lightseek_infographic_numbered_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'arrow-right-alt',  
      'keywords' => array('infographics', 'steps', 'arrow', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
    ));
  }
}

function lightseek_infographic_numbered_callback($block)
{
 
    $steps = get_field('steps');

?>

<div class="infographic-numbered-wrapper">
    <?php $i=1; foreach ($steps as $step) : 
                 ?>
        <div class="step"><span class="number"><?php echo $i; ?></span><span class="label"><?php echo esc_html( $step['label'] ); ?></span></div>
        <div class="arrow"></div>           
    <?php $i++; endforeach; ?>
</div>

<?php
}

