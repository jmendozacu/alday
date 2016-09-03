<?php
$out = $image = '';

extract(shortcode_atts(array(
	"title" => '',
	"image" => $image,
	"link" => '',
	"text" => '',
	"download" => '',
	"btntext1" => '',
	"icon1" => '',
	"link1" => '',
	"btntext2" => '',
	"icon2" => '',
	"link2" => '',
	'css_animation' => ''
), $atts));	

$img = wp_get_attachment_image_src( $image, 'large' );

$final_dload = $download != '' ? '<span class="downloadBox-text robotoCondensed  pull-left">'.wp_kses_post($download).'</span>' : '';
$final_btntext1 = $btntext1 != '' || $icon1 != '' ? '
					<a href="'.esc_url($link1).'" target="_blank">
						<span class="downloadBox-appbox robotoCondensedBold pull-left text-center">
							<i class="fa '.esc_attr($icon1).'"></i>
							'.wp_kses_post($btntext1).'
						</span>
					</a>' : '';
$final_btntext2 = $btntext2 != '' || $icon2 != '' ? '
					<a href="'.esc_url($link2).'" target="_blank">
						<span class="downloadBox-appbox robotoCondensedBold pull-left text-center">
							<i class="fa '.esc_attr($icon2).'"></i>
							'.wp_kses_post($btntext2).'
						</span>
					</a>' : '';
$final_download = $final_dload != '' || $final_btntext1 != '' || $final_btntext2 != '' ? '<div class="downloadBox pull-left clear arrowFreeDownload">'.$final_dload.$final_btntext1.$final_btntext2.'</div>' : '';
	
$img_output = $img[0];
$out = $css_animation != '' ? '<div class="" data-animation="' . esc_attr($css_animation) . '">' : '';

$out .= '
		<div class="downloadConainer row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 clearfix">
				<a class="ellipseBtn smallBtn customWhiteBtn pull-left clear" >
					<span class="text-uppercase">'.wp_kses_post($text).'</span>
				</a>
				<h3 class="sectionName ralewaySemiBold pull-left clear">'.wp_kses_post($title).'</h3>
				
				<div class="sectionDesc robotoLight pull-left clear">
					'.do_shortcode($content).'
				</div>
				'.$final_download.'
			</div>
			<div class="posterBox col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a href="'.esc_url($link).'" target="_blank"><img alt="'.esc_attr($title).'" src="'.esc_url($img_output).'" ></a>
			</div>
		</div>
  ';
$out .= $css_animation != '' ? '</div>' : '';		
echo $out;