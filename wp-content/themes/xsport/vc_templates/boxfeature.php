<?php
$out = $css_class = '';

extract(shortcode_atts(array(
	'title'=>'',
	'icon'=>'',
	'css_animation' => '',
), $atts));

$css_class .= $this->getCSSAnimation($css_animation);
$out  = '<div class="' . esc_attr($css_class) . '">';
$out .= '
			<div class="feature-item text-center clearfix hvr-pop">
				<div class="circle bigCircle center-block">
					<span><i class="fa '.esc_attr($icon).' customColor"></i></span>
				</div>
				<span class="feature-item_title text-uppercase text-center ralewaySemiBold col-lg-12 col-md-12 col-sm-12 col-xs-12 blackTxtColor">'.wp_kses_post($title).'</span>
				<span class="feature-item_desc text-center robotoLight col-lg-12 col-md-12 col-sm-12 col-xs-12">'.do_shortcode($content).'</span>
			</div>

	'; 
$out .= '</div>';
echo $out;