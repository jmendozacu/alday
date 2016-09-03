<?php
$out = '';

extract(shortcode_atts(array(
	'title'=>'',
	'link'=>'',
	'icon' => '',
	'color' => '',
), $atts));


$out .='

	<a href="'.esc_url($link).'" target="_blank" class="ellipseBtn bigBtn '.esc_attr($color).'">
		<span>
			<i class="fa '.esc_attr($icon).'"></i>
			'.wp_kses_post($title).'
		</span>
	</a>
	
  ';
 

echo $out;