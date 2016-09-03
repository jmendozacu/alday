<?php
$out = '';

extract(shortcode_atts(array(
	'title'=>'',
	'icon'=>'',
	'button_text'=>'',
	'link'=>'',
), $atts));

$out='

<div class="service-item text-center">
            <div class="service-icon123"> <a href="'.esc_url($link).'" ><i class="fa '.esc_attr($icon).'"></i></a></div>
            <h4 class="service-heading">'.wp_kses_post($title).'</h4>
           '.do_shortcode($content).'  
			  
          </div>

	'; 

echo $out;