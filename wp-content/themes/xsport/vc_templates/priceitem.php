<?php 
		$out = $image = '';
		
		
	extract(shortcode_atts(array(
	 	"title" => '',
		"price" => '',
	 	"offer1" => '',
	 	"offer2" => '',
	 	"offer3" => '',
	 	"offer4" => '',
	 	"offer5" => '',	 		 		 		 	
		"subscribe" => '',
		"subscribe_link" => ''
	), $atts));
	
	$x = $GLOBALS['priceitems_count'];
	$GLOBALS['priceitems'][$x] = array('title' => esc_attr($title),'price' => esc_attr($price),'offer1' => wp_kses_post($offer1),'offer2' => wp_kses_post($offer2),'offer3' => wp_kses_post($offer3),'offer4' => wp_kses_post($offer4),'offer5' => wp_kses_post($offer5), 'subscribe' => wp_kses_post($subscribe),  'subscribe_link' => esc_url($subscribe_link));
	
	$GLOBALS['priceitems_count']++;
?>