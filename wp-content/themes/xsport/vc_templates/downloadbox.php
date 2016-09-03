<?php
$out = $image = $btn1 = $btn2 = $finalbtn = '';

extract(shortcode_atts(array(
	"title" => '',
	"text" => '',
	"image" => $image,
	"btntext1" => '',
	"icon1" => '',
	"link1" => '',
	"btntext2" => '',
	"icon2" => '',
	"link2" => '',	
), $atts));	

$img = wp_get_attachment_image_src( $image, 'large' );	
$img_output = $img[0];

$btn1 = ($btntext1 == "") ? "" : '
				<li class="pull-left">
					<a href="'.esc_url($link1).'" class="ellipseBtn bigBtn whiteBtn">
						<span>
							<i class="fa '.esc_attr($icon1).'"></i>
							'.wp_kses_post($btntext1).'
						</span>
					</a>
				</li>
				';
$btn2 = ($btntext2 == "") ? "" : '
				<li class="pull-right">
					<a href="'.esc_url($link2).'" class="ellipseBtn bigBtn colorBtn">
						<span>
							<i class="fa '.esc_attr($icon2).'"></i>
							'.wp_kses_post($btntext2).'
						</span>
					</a>
				</li>
				';
$finalbtn = $btn1 == '' && $btn2 == '' ? '' : '<ul class="store-buttons center-block clearfix">'.$btn1.$btn2.'</ul>';

$out = '
		<div class="phonesImgBox col-lg-5 col-md-5 col-sm-12 col-xs-12 clearfix">
			<img src="'.esc_url($img_output).'" alt="'.esc_url($title).'">
		</div>
		<div class="downloadContainer col-lg-7 col-md-7 col-sm-12 col-xs-12 clearfix">
			<h4 class="download-title ralewayLight blackTxtColor">'.wp_kses_post($title).'</h4>
			<span class="download-subtitle robotoLight">'.wp_kses_post($text).'</span>
			'.$finalbtn.'
			'.do_shortcode($content).'
		</div>
';
	
echo $out;