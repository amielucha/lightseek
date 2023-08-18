<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_themed_buttons_block'); // 1. rename all instances of this and callback functions.
function lightseek_themed_buttons_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'themed_buttons', // 2. Set a slug.
      'title' => __('Themed Buttons'), // 3. Set a title.
      'description' => __('Adds adds button links in primary theme colours.'), // 4. Add description.
      'render_callback' => 'lightseek_themed_buttons_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'button', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('button', 'theme', 'lightseek', 'iseek'), // 6. Add keywords.
      'mode'              => 'auto',
    ));
  }
}

function lightseek_themed_buttons_callback($block)
{
 
    $buttons = get_field('buttons');

?>

<div class="button-wrapper">
    <?php foreach ($buttons as $button) : 
        $button_url = $button['link']['url'];
        $button_title = $button['link']['title'];
        $button_target = $button['link']['target'] ? $button['link']['target'] : '_self'; ?>

        <a class="btn btn-primary" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a>

    <?php endforeach; ?>
</div>

<?php
}

