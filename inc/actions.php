<?php

/**
 * Footer Nav
 */
function lightseek_footer_nav()
{
  echo '<nav class="footer-navigation">';
  wp_nav_menu(array(
    'theme_location' => 'footer',
    'menu_id'        => 'footer-menu',
    'menu_class'     => 'nav',
    'depth'           => 1,
  ));
  echo '</nav>';
}

lightseek_get_option('footer-menu') &&
  add_action('lightseek_footer', 'lightseek_footer_nav');

/**
 * Legal Nav
 */
function lightseek_legal_nav()
{
  echo '<nav class="legal-navigation">';
  wp_nav_menu(array(
    'theme_location' => 'legal',
    'menu_id'        => 'legal-menu',
    'menu_class'     => 'nav',
    'depth'           => 1,
  ));
  echo '</nav>';
}

function lightseek_legal_link()
{
  if (function_exists('the_privacy_policy_link'))
    the_privacy_policy_link('<div class="lightseek-pp">', '</div>');
}

if (lightseek_get_option('legal-menu'))
  add_action('lightseek_footer', 'lightseek_legal_nav');
else
  add_action('lightseek_footer', 'lightseek_legal_link');



function lightseek_copyright()
{
  echo '<div>&copy; Copyright '
    . date('Y')
    . ' '
    .  get_bloginfo('name')
    . '. All rights Reserved.</div>';
}
add_action('lightseek_footer', 'lightseek_copyright');


/**
 * iSeek Link
 */
function lightseek_designed_by()
{
  printf(__('<a href="%1$s" title="%2$s" target="_blank" class="iseek-link">%3$s ', 'lightseek'), 'http://www.iseek.ie', 'Seek Internet Solutions, Fermoy, Cork, Ireland', 'Website Crafted by ');
  include get_template_directory() . '/images/iseek-logo.svg';
  echo '</a>';
}
add_action('lightseek_footer', 'lightseek_designed_by');


/**
 * Mobile nav button
 */
function lightseek_mobile_toggle()
{
  ?>
  <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo lightseek_get_option('fontawesome')['enabled'] ? '<i class="far fa-bars"></i>' : esc_html('Menu', 'lightseek'); ?></button>
<?php
}

add_action('lightseek_mobile_toggle', 'lightseek_mobile_toggle');
