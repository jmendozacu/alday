<?php
$out = '';

extract(shortcode_atts(array(	
	"text" => '',
	"title1" => '',
	"icon1" => '',
	"info1" => '',
	"title2" => '',
	"icon2" => '',
	"info2" => '',
	"title3" => '',
	"icon3" => '',
	"info3" => '',	
), $atts));	

$out = '

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 clearfix">
	<div class="support-item clearfix">
		<div class="circle smallCircle">
			<span><i class="fa '.esc_attr($icon1).' customColor"></i></span>
		</div>
		<h4 class="support-item_name ralewaySemiBold blackTxtColor">'.wp_kses_post($title1).'</h4>
		<div class="support-item_info robotoLight">'.wp_kses_post($info1).'</div>
	</div>
	<div class="support-item clearfix">
		<div class="circle smallCircle">
			<span><i class="fa '.esc_attr($icon2).' customColor"></i></span>
		</div>
		<h4 class="support-item_name ralewaySemiBold blackTxtColor">'.wp_kses_post($title2).'</h4>
		<div class="support-item_info robotoLight">
			'.wp_kses_post($info2).'
		</div>
	</div>
	<div class="support-item clearfix">
		<div class="circle smallCircle">
			<span><i class="fa '.esc_attr($icon3).' customColor"></i></span>
		</div>
		<h4 class="support-item_name ralewaySemiBold blackTxtColor">'.wp_kses_post($title3).'</h4>
		<div class="support-item_info robotoLight">
			'.$info3.'
		</div>
	</div>
</div>

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 clearfix">
	<div class="support-desc robotoLight">'.wp_kses_post($text).'</div>
	<div class="support-formbox clearfix">
		'.do_shortcode($content).'
	</div>
</div>

';
	
echo $out;