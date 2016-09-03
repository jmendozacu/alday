<?php

    $output = '';


	extract(shortcode_atts(array(
		'title' => '',
		'more' => '',
		'phone' => ''
		
	), $atts));
	
	//var_dump($more);die;
	

	
	$GLOBALS['priceitems'] = array();
	do_shortcode($content);	 	
	$GLOBALS['priceitems_count'] = 0;
	
	
	
	
	if( is_array( $GLOBALS['priceitems'] ) ){
		$count = 1;
		foreach( $GLOBALS['priceitems'] as $item ){
			$class = $count == 1 ? 'class="active"' : '';
			$offerHtml = '';
			for ($ind = 0; $ind < 10; $ind++){
				if (isset($item['offer' . $ind])){
					$offerIndHtml = $item['offer' . $ind];
					if ($offerIndHtml && $offerIndHtml != ''){
						$offerHtml .= '<div class="ptable-offer-item">
				<div class="flex-item">'.$offerIndHtml.'</div>
				</div>';	
					}
				}
			}
			
			
			
			$out = '<div class="table-line">
				<div class="price-plan-wrap">
				<h3>'.$item['title'].'</h3>
				<div class="price-plan">'.$item['price'].'</div>
				</div>
				'.$offerHtml.'
				<div class="ptable-offer-button"><a href="'.$item['subscribe_link'].'">'.$item['subscribe'].'</a></div>
				</div>';
			
			
			$reviews[] = $out;
			 
			$count ++;
		}
		
		
		
		
        

		$output = '<div class="price-table">
			<div class="ptable-heading">
			<div class="ptable-our-packet"><i class="fa fa-arrow-circle-down"></i>'.$title.'</div>
			<div class="ptable-more-info">'.$more.'</div>
			<div class="ptable-phone">'.$phone.'</div>
			</div>'.implode( "\n", $reviews ).'</div>';
					
	}
	echo $output;
	
  

	
	
?>