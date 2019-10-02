<?php

/** 
 * Define ACF Fields for the Block
 */
if (function_exists('acf_add_local_field_group')) :

  acf_add_local_field_group(array(
    'key' => 'group_5d075586901fe',
    'title' => 'Contact Block',
    'fields' => array(
      array(
        'key' => 'field_5d075594c507e',
        'label' => 'Show Address',
        'name' => 'show_address',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 1,
        'ui' => 1,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
      array(
        'key' => 'field_5d0755b7c5080',
        'label' => 'Show Phone',
        'name' => 'show_phone',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 1,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
      array(
        'key' => 'field_5d076c7270631',
        'label' => 'Show Email',
        'name' => 'show_email',
        'type' => 'true_false',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'message' => '',
        'default_value' => 0,
        'ui' => 1,
        'ui_on_text' => '',
        'ui_off_text' => '',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/contact',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
  ));

endif;

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_contact_block'); // 1. rename all instances of this and callback functions.
function lightseek_contact_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'contact', // 2. Set a slug.
      'title' => __('Contact Details'), // 3. Set a title.
      'description' => __('Contact details configured on the <a href="/admin.php?page=acf-options">Options page</a>.'), // 4. Add description.
      'render_callback' => 'lightseek_contact_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'email-alt', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('contact', 'lightseek', 'iseek'), // 6. Add keywords.
    ));
  }
}

function lightseek_contact_callback($block)
{
  // 7. Load and the ACF fields.
  $show_address = get_field('show_address');
  $show_phone = get_field('show_phone');
  $show_email = get_field('show_email');
  $address = get_field('address', 'options');
  $phone = get_field('phone', 'options') && isset(get_field('phone', 'options')['number'], get_field('phone', 'options')['label']) ? get_field('phone', 'options') : false;
  $email = get_field('email', 'options');
  ?>
  <style>
    .contact-set {
      display: grid;
      grid-template-columns: auto 1fr;
      align-items: baseline;
      grid-column-gap: .5em;
    }

    .contact-set > * {
      justify-self: start;
    }

    .contact-set a {
      text-decoration: none;
    }

    .contact-set>.svg-inline--fa {
      margin-top: .2em;
      color: inherit;
    }

    .contact-phone a {
      white-space: nowrap;
    }
  </style>
  <section class="section--contact align<?php echo $block['align'] ?> <?php if (isset($block['className'])) echo $block['className'] ?>">
    <?php
    echo $show_address && !empty($address) ? '<p class="contact-address contact-set"><i class="far fa-map-marked fa-fw"></i> ' . $address . '</p>' : '';
    echo $show_phone && !empty($phone) ? '<p class="contact-phone contact-set"><i class="far fa-phone-alt fa-fw"></i> <a class="" href="tel:' . $phone['number'] . '">' . $phone['label'] . '</a></p>' : '';
    echo $show_email && !empty($email) ? '<p class="contact-email contact-set"><i class="far fa-envelope fa-fw"></i> <a class="" href="mailto:' . $email . '">' . $email . '</a></p>' : '';
    ?>
  </section>
<?php
}

// 8. Don't forget to require this file in blocks.php.
// 9. Consider adding the ACF field definitions to the file if packaging for reuse.
