<?php
$out = $image = '';

extract(shortcode_atts(array(
	'image'=>$image,
	'url'=>'',	
	'css_animation' => ''			
), $atts));

$img = wp_get_attachment_image_src( $image, 'medium' );
	
$img_output = $img[0];


$out .= '<li><img src="'.esc_url($img_output).'" width="220" height="66" alt="logo"></li>';
	
echo $out;