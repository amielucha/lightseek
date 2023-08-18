<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_homescreeningpanel_block'); // 1. rename all instances of this and callback functions.
function lightseek_homescreeningpanel_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'homescreeningpanel', // 2. Set a slug.
      'title' => __('Home Screening Panel'), // 3. Set a title.
      'description' => __('Adds a series of panels for Home Based Health Screening Checks with inflow, modal info panels and a link per panel.'), // 4. Add description.
      'render_callback' => 'lightseek_homescreeningpanel_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'shield', // 5. Select dashicon: https://developer.wordpress.org/resource/dashicons/
      'keywords' => array('homescreeningpanel', 'lightseek', 'iseek'), // 6. Add keywords.
      'mode'              => 'auto',
    ));
  }
}

function lightseek_homescreeningpanel_callback($block)
{
 
    $home_screening_check_panel = get_field('home_screening_check_panel');

  ?>
<section class="home-screen-panel">
	<div class="panel-flex">
        <?php foreach($home_screening_check_panel as $panel) : ?>
            <div class="panel">
                <div class="inner-wrap">
                    <h4 class="panel-title"><?php echo $panel['title']; ?></h4>
                        <div class="includes-label"><?php echo $panel['includes_label']; ?></div>
                           <ul class="includes">
                                <?php 
                                      $includes = $panel['includes'];  
                                      foreach ($includes as $include) : ?>
                                    <li><div><?php echo $include['item']; ?><?php if ($include['info']) { ?><span class="info-trigger">?</span></span><span class="info"><?php echo $include['info']; ?></span><?php } ?></div></li>
                                <?php endforeach; ?>
                           </ul> 
                           <?php if ($panel['extras_label']) : ?>
                           <div class="extras-label"><?php echo $panel['extras_label']; ?></div>
                           <div class="extras-text"><?php echo $panel['extras_text']; ?></div>
                           <ul class="extras">
                                <?php $extras = $panel['extras'];
                                      foreach ($extras as $extra) : ?>
                                    <li><div><?php echo $extra['item']; ?><?php if ($extra['info']) { ?><span class="info-trigger">?</span><span class="info"><?php echo $extra['info']; ?></span><?php } ?></div></li>
                                <?php endforeach; ?>
                           </ul> 
                           <?php endif; ?>
                           <div class="price"><?php echo $panel['price']; ?></div>
                           <div class="link"><a class="btn btn-primary" href="<?php echo $panel['link']; ?>" target="_blank"><?php echo $panel['label']; ?></a></div>
                </div>
            </div>
        <?php endforeach; ?>
	</div>
</section>
<?php
}

// 8. Don't forget to require this file in blocks.php.
// 9. Consider adding the ACF field definitions to the file if packaging for reuse.
