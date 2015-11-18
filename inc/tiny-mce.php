<?php
//Add the Page Break Button to TinyMCE Menu after the More Button
function lightseek_mce_page_break($mce_buttons) {
	$pos = array_search('wp_more', $mce_buttons, true);
	if ($pos !== false) {
		$buttons = array_slice($mce_buttons, 0, $pos + 1);
		$buttons[] = 'wp_page';
		$mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos + 1));
		}
	return $mce_buttons;
}

add_filter('mce_buttons', 'lightseek_mce_page_break');
