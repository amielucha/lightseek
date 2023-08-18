<?php

/** 
 * Register ACF Gutenberg Block
 */
add_action('acf/init', 'lightseek_team_members_block'); // 1. rename all instances of this and callback functions.
function lightseek_team_members_block()
{
  // check if function exists
  if (function_exists('acf_register_block')) {

    // register the block block
    acf_register_block(array(
      'name' => 'team_members', 
      'title' => __('Team Members'),  
      'description' => __('Creates grid of selected team members.'), 
      'render_callback' => 'lightseek_team_members_callback',
      'category' => 'lightseek-blocks',
      'icon' => 'groups',  
      'keywords' => array('referral', 'link', 'lightseek', 'iseek'), 
      'mode'              => 'auto',
       'supports' => ['align'=>false],
    ));
  }
}

function lightseek_team_members_callback($block)
{
$team_members = get_field('team_members');
?>  

<div class="team-members-wrapper">

<?php foreach($team_members as $member) :
    ?>

       <div class="team-member">
            <div class="member-photo">
                <?php if (has_post_thumbnail( $member->ID )) : ?>
                    <?php $member_photo = get_the_post_thumbnail_url($member->ID, 'large'); ?>
                    <img class="image" src="<?php echo $member_photo; ?>" />
                <?php else : ?>
                    <?php echo file_get_contents(get_stylesheet_directory() . '/images/user-solid.svg'); ?>
                <?php endif; ?>
            </div>
            <div class="member-name"><?php echo get_the_title( $member->ID ); ?></div>
            <?php echo (get_field('team_member_degrees', $member->ID)) ? '<div class="member-name">' . get_field('team_member_degrees', $member->ID) . '</div>': ''; ?>
            <?php if (get_field('team_member_title', $member->ID)) : ?><div class="member-title"><?php the_field('team_member_title', $member->ID); ?></div><?php endif; ?>
            <div class="excerpt">
                <?php if (get_field('short_bio', $member->ID)) : ?>
                    <?php the_field('short_bio', $member->ID) ?>
                <?php else : ?>
                    <?php echo apply_filters('the_content', get_the_content( null, false, $member->ID )); ?>
                <?php endif; ?>
            </div>
       </div>
<?php endforeach;  ?>

</div>

<script>
    jQuery(document).ready(($) => {

    $('.team-members-wrapper .team-member .member-photo').on('click', function(event) {
        $(this).siblings('.excerpt').slideToggle();
        $(this).siblings('.excerpt').toggleClass('open');
    });
});

</script>

<?php
}

