<?php
$out = $css_class = '';

extract(shortcode_atts(array(
	'title'=>'',
	'arrow'=>'',
	'color'=>'',
	'css_animation' => '',
), $atts));

$fullcontent = ($content == "") ? "" : '
	<span class="smallText text-center robotoLight '.esc_attr($color).'TxtColor ">'.do_shortcode($content).'</span>
';

$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .='
	<h3 class="sectionTitle text-center ralewayLight '.esc_attr($color).' '.esc_attr($arrow).'">'.wp_kses_post($title).'</h3>
  '.$fullcontent; 
$out .= $css_animation != '' ? '</div>' : '';

echo $out;