<?php
$out = $css_class = '';

extract(shortcode_atts(array(
	'title'=>'',
	'icon'=>'',
	'arrow'=>'',
	'color'=>'',
	'css_animation' => '',
), $atts));

$fullicon = ($icon == "") ? "" : '<div class="bottom-bracket '.esc_attr($color).'TxtColor circleBox center-block text-center"><i class="fa ' . esc_attr($icon) . '"></i></div>';

$fullcontent = ($content == "") ? "" : '
<span class="reviews-subtitle robotoLight '.esc_attr($color).'TxtColor text-center">'.do_shortcode($content).'</span>
';

$out = $css_animation != '' ? '<div class="" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .= $fullicon.'
		<h2 class="title_bold text-center ralewaySemiBold '.esc_attr($color).'TxtColor '.esc_attr($arrow).'">'.wp_kses_post($title).'</h2>
  		'.$fullcontent;
 
$out .= $css_animation != '' ? '</div>' : '';

echo $out;