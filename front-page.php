<?php
/**
 * The main front-page template file.
 *
 * @package lightseek
 */

get_header();

?>

<?php get_template_part( 'modules/front', 'hero' ); ?>
<?php get_template_part( 'modules/front', 'screenings' ); ?>
<?php //get_template_part( 'modules/front', 'testimonial' ); ?>
<?php //get_template_part( 'modules/front', 'content' ); ?>
<?php the_content(); ?>
<?php //get_template_part( 'modules/front', 'news' ); ?>

<?php

get_footer();
