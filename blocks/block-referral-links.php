<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_referral_links_block'); // 1. rename all instances of this and callback functions.
function lightseek_referral_links_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'referral_links', 
      'title' => __('Referral Links'),  
      'description' => __('Creates grid of link buttons.'), 
      'render_callback' => 'lightseek_referral_links_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'paperclip',  
      'keywords' => array('referral', 'link', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
       'supports' => ['align'=>false],
    ));
  }
}

function lightseek_referral_links_callback($block)
{
 
$links = get_field('links');
$count = count($links);
$column_break = ceil($count / 2);
$x = 0;
?>  

<div class="referral-links-wrapper">
    <div class="link-wrapper">
   <?php foreach($links as $l) :
  
    $link = $l['link'];    
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
       <div class="button-wrap">
            <div class="btn btn-primary btn-grey">
                    <?php echo $l['label']; ?>
                    <div class="content">
                        <?php echo $l['content']; ?>
                        <?php if ($l['insurance_price']) : ?><div class="ins"><span><?php _e('Insurance:','lightseek'); ?></span><?php echo $l['insurance_price']; ?></div><?php endif; ?>
                        <?php if ($l['self-payment_price']) : ?><div class="self"><span><?php _e('Self-payment:','lightseek'); ?></span><?php echo $l['self-payment_price']; ?></div><?php endif; ?>
                        <?php if ($l['single_price']) : ?><div class="single"><?php echo $l['single_price']; ?></div><?php endif; ?>
                        <a class="btn btn-primary btn-white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    </div>
            </div>
        </div> 

    <?php $x++;
          if ($x == $column_break) { ?>
        </div>
        <div class="link-wrapper">
    <?php } ?>

   <?php endforeach; ?>
    </div>
</div>

<script>
    jQuery(document).ready(($) => {

    $('.button-wrap .btn').on('click', function(event) {
        $(this).toggleClass('open');
        $(this).find('.content').slideToggle();
    });
});

</script>

<?php
}

