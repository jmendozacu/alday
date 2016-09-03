<?php 
	
	$image = '';
	extract(shortcode_atts(array(
	 	'image' => $image,
		'title' => '',
		'short_desc' => '',
		'button_text' => '',
		'link' => '',
	), $atts));
	
	
	
	$img = wp_get_attachment_image_src( esc_attr($image), 'full' );		
	$img_output = $img[0];
	
	$x = $GLOBALS['archmnts_count'];
	$GLOBALS['archmnts'][$x] = array( 'image' => esc_url($img_output), 'title' => esc_attr($title), 'short_desc' => wp_kses_post($short_desc), 'button_text' => esc_attr($button_text), 'link' => esc_url($link), 'content' => wp_kses_post($content) );
	
	$GLOBALS['archmnts_count']++;
	
?>