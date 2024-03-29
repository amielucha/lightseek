<?php
/**
 * The theme header.
 *
 * @package lightseek
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:image" content=""/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head();
	// TODO: remove if not needed
	$body_class = '';
	if( is_single() && has_post_thumbnail() ) $body_class .= 'with-cover';
?>

<body <?php body_class($body_class); ?>>

	<?php if ( SeekConfig::TOPBAR )
		get_template_part( 'modules/topbar', 'default' );
	?>

	<?php get_template_part( 'modules/header', 'split' ); ?>

<div id="page-wrapper" class="page-wrapper">
	<div id="page" class="hfeed site">
		<div id="content" class="site-content">
