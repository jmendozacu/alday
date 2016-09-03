<?php
$out = '';

extract(shortcode_atts(array(
	'images'=>'',				
), $atts));

$images = explode( ',', $images );

$out = '
		<div id="owl-screenshots" class="owl-carousel phone-slider">
		';
foreach( $images as $image ){
	if ( $image > 0 ) {
		$img = wp_get_attachment_image_src( $image, array(257,453) );
		$img_output = $img[0];
	} else {
		$img_output = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
	}
	$out .=	'
			<div class="screenshot-item wow fadeInLeft" data-wow-delay="0.3s">
						<img src="'.esc_url($img_output).'" alt="Screenshot">
					</div>
				
			';
}
$out .=	'				
			</div>
		</div>
		
	</div>
	';	
echo $out;