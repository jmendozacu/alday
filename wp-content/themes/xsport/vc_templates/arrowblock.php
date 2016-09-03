<?php
$out = $out_block = $img_block = $cont_block = $arrow = $image = '';

extract(shortcode_atts(array(
		"image" => $image,	
		"title" => '',		
		"imgpos" => '',			
		"arrowpos" => '',
	), $atts));	

$img = wp_get_attachment_image_src( $image, 'middle' );
	
$img_output = $img[0];

$arrow = $arrowpos != '' ? '<div class="arrow"></div>' : '';

$img_block = '
		<div class="pp-box pp-image">
		  <div class="media"> <img src="'.esc_url($img_output).'" width="290" height="250" alt="'.esc_attr($title).'"> </div>
		</div>
		';
		
$cont_block = '
		<div class="pp-box ">
		  <div class="pp-content '.esc_attr($arrowpos).'">
			'.$arrow.'
			<h5>'.wp_kses_post($title).'</h5>
			<p>'.do_shortcode($content).'</p>
		  </div>
		</div>
		';

$out_block = $imgpos == 'left' ? ($img_block.$cont_block) : ($cont_block.$img_block); 
		
	$out = '
	  <div class="pp-box-item">		
		'.$out_block.'		
	  </div>  
	';

echo $out;