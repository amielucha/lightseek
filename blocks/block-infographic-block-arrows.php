<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_infographic_blocked_arrows_block'); // 1. rename all instances of this and callback functions.
function lightseek_infographic_blocked_arrows_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'infographic_blocked_arrows', 
      'title' => __('Infographic with Block Arrow Backgrounds'), 
      'description' => __('Creates a stepped info graphic with block arrows as backgrounds for each step, max 6.'), 
      'render_callback' => 'lightseek_infographic_blocked_arrows_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'controls-forward', 
      'keywords' => array('infographics', 'steps', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
    ));
  }
}

function lightseek_infographic_blocked_arrows_callback($block)
{
 
    $steps = get_field('steps');

?>

<div class="infographic-block-arrow-wrapper">
    <?php $i=count($steps); foreach ($steps as $step) : 
                 ?>
      <div class="step-wrapper step<?php echo $i; ?>">
        <div class="step"><span class="label"><?php echo esc_html( $step['label'] ); ?></span></div>
        <?php if ($step['text']) : ?>
        <div class="step-text"><?php echo $step['text']; ?></div>
        <?php endif; ?>
      </div>
    <?php $i=($i - 1); endforeach; ?>
</div>

<?php
}

