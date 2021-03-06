<?php

    $output = '';


	extract(shortcode_atts(array(
		'max_slides' => '',
		'min_slides' => '',
		'width_slides' => '',
		'margin_slides' => '',
		'auto_slides' => '',
		'move_slides' => '',
		'infinite_slides' => '',
		'disable_carousel' => '',
	), $atts));
	

	
	$GLOBALS['brands'] = array();
	do_shortcode($content);	 	
	$GLOBALS['brands_count'] = 0;
	
	
	
	
	if( is_array( $GLOBALS['brands'] ) ){
		$count = 1;
		foreach( $GLOBALS['brands'] as $item ){
			$class = $count == 1 ? 'class="active"' : '';
			
			$out = '
			<li class="active">
              <div class="x-item-wrap">
            	<div class="logo-box"> <div class="logo-box-item"><a href="'.esc_url($item['link']).'"><img  alt="brand" src="'.esc_url($item['image']).'" ></a></div></div>  
              </div>
            </li>
            ';
			
			
			$reviews[] = $out;
			 
			$count ++;
		}
        
		$max_slides = $max_slides == '' ? 3 : $max_slides;
		$min_slides = $min_slides == '' ? 1 : $min_slides;
		$width_slides = $width_slides == '' ? 380 : $width_slides;
		$margin_slides = $margin_slides == '' ? 10 : $margin_slides;
		$auto_slides = $auto_slides != '0' ? 'true' : 'false';
		$move_slides = $move_slides == ''? 3 : $move_slides;
		$infinite_slides = $infinite_slides != '1' ? 'false' : 'true';
		$disable_carousel = $disable_carousel != '0' ? 'bxslider' : 'carousel-disable';
		       
		$output = ' 
				<div class="xcarousel-1">
					<div class="x-frame" >
						<ul class="x-carousel brand-carousel '.esc_attr($disable_carousel).'" 
							data-max-slides="'.esc_attr($max_slides).'" 
							 data-min-slides="'.esc_attr($min_slides).'" 
							data-width-slides="'.esc_attr($width_slides).'" 
							data-margin-slides="'.esc_attr($margin_slides).'" 
								data-auto-slides="'.esc_attr($auto_slides).'" 
							data-move-slides="'.esc_attr($move_slides).'"   
							data-infinite-slides="'.esc_attr($infinite_slides).'" >
							'.implode( "\n", $reviews ).'
						</ul>
					</div>
					<div class="x-navigation navigation"> <a href="javascript:void(0);" class="btn slider-direction prev-page "><i class="icomoon-arrow-left2"></i></a> <a href="javascript:void(0);" class="btn  slider-direction next-page"><i class="icomoon-arrow-right2"></i></a> </div>
				</div>';
					
	}
	echo $output;
	
  

	
	
?>