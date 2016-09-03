<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
 
add_action( 'init', 'pixtheme_integrateWithVC', 200 );
function pixtheme_integrateWithVC() {

	
	//ie;
	
	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => __( 'CSS Animation', 'js_composer' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			__( 'No', 'PixShortcode' ) => '',
			__( 'bounce', 'PixShortcode' ) => 'bounce',
			__( 'flash', 'PixShortcode' ) => 'flash',
			__( 'pulse', 'PixShortcode' ) => 'pulse',
			__( 'rubberBand', 'PixShortcode' ) => 'rubberBand',
			__( 'shake', 'PixShortcode' ) => 'shake',
			__( 'swing', 'PixShortcode' ) => 'swing',
			__( 'tada', 'PixShortcode' ) => 'tada',
			__( 'wobble', 'PixShortcode' ) => 'wobble',
			__( 'jello', 'PixShortcode' ) => 'jello',
			
			__( 'bounceIn', 'PixShortcode' ) => 'bounceIn',
			__( 'bounceInDown', 'PixShortcode' ) => 'bounceInDown',
			__( 'bounceInLeft', 'PixShortcode' ) => 'bounceInLeft',
			__( 'bounceInRight', 'PixShortcode' ) => 'bounceInRight',
			__( 'bounceInUp', 'PixShortcode' ) => 'bounceInUp',
			__( 'bounceOut', 'PixShortcode' ) => 'bounceOut',
			__( 'bounceOutDown', 'PixShortcode' ) => 'bounceOutDown',
			__( 'bounceOutLeft', 'PixShortcode' ) => 'bounceOutLeft',
			__( 'bounceOutRight', 'PixShortcode' ) => 'bounceOutRight',
			__( 'bounceOutUp', 'PixShortcode' ) => 'bounceOutUp',
			
			__( 'fadeIn', 'PixShortcode' ) => 'fadeIn',
			__( 'fadeInDown', 'PixShortcode' ) => 'fadeInDown',
			__( 'fadeInDownBig', 'PixShortcode' ) => 'fadeInDownBig',
			__( 'fadeInLeft', 'PixShortcode' ) => 'fadeInLeft',
			__( 'fadeInLeftBig', 'PixShortcode' ) => 'fadeInLeftBig',
			__( 'fadeInRight', 'PixShortcode' ) => 'fadeInRight',
			__( 'fadeInRightBig', 'PixShortcode' ) => 'fadeInRightBig',
			__( 'fadeInUp', 'PixShortcode' ) => 'fadeInUp',
			__( 'fadeInUpBig', 'PixShortcode' ) => 'fadeInUpBig',			
			__( 'fadeOut', 'PixShortcode' ) => 'fadeOut',
			__( 'fadeOutDown', 'PixShortcode' ) => 'fadeOutDown',
			__( 'fadeOutDownBig', 'PixShortcode' ) => 'fadeOutDownBig',
			__( 'fadeOutLeft', 'PixShortcode' ) => 'fadeOutLeft',
			__( 'fadeOutLeftBig', 'PixShortcode' ) => 'fadeOutLeftBig',
			__( 'fadeOutRight', 'PixShortcode' ) => 'fadeOutRight',
			__( 'fadeOutRightBig', 'PixShortcode' ) => 'fadeOutRightBig',
			__( 'fadeOutUp', 'PixShortcode' ) => 'fadeOutUp',
			__( 'fadeOutUpBig', 'PixShortcode' ) => 'fadeOutUpBig',
			
			__( 'flip', 'PixShortcode' ) => 'flip',
			__( 'flipInX', 'PixShortcode' ) => 'flipInX',
			__( 'flipInY', 'PixShortcode' ) => 'flipInY',
			__( 'flipOutX', 'PixShortcode' ) => 'flipOutX',
			__( 'flipOutY', 'PixShortcode' ) => 'flipOutY',
			
			__( 'lightSpeedIn', 'PixShortcode' ) => 'lightSpeedIn',
			__( 'lightSpeedOut', 'PixShortcode' ) => 'lightSpeedOut',
			
			__( 'rotateIn', 'PixShortcode' ) => 'rotateIn',
			__( 'rotateInDownLeft', 'PixShortcode' ) => 'rotateInDownLeft',
			__( 'rotateInDownRight', 'PixShortcode' ) => 'rotateInDownRight',
			__( 'rotateInUpLeft', 'PixShortcode' ) => 'rotateInUpLeft',
			__( 'rotateInUpRight', 'PixShortcode' ) => 'rotateInUpRight',			
			__( 'rotateOut', 'PixShortcode' ) => 'rotateOut',
			__( 'rotateOutDownLeft', 'PixShortcode' ) => 'rotateOutDownLeft',
			__( 'rotateOutDownRight', 'PixShortcode' ) => 'rotateOutDownRight',
			__( 'rotateOutUpLeft', 'PixShortcode' ) => 'rotateOutUpLeft',
			__( 'rotateOutUpRight', 'PixShortcode' ) => 'rotateOutUpRight',
			
			__( 'slideInUp', 'PixShortcode' ) => 'slideInUp',
			__( 'slideInDown', 'PixShortcode' ) => 'slideInDown',
			__( 'slideInLeft', 'PixShortcode' ) => 'slideInLeft',
			__( 'slideInRight', 'PixShortcode' ) => 'slideInRight',
			__( 'slideOutUp', 'PixShortcode' ) => 'slideOutUp',			
			__( 'slideOutDown', 'PixShortcode' ) => 'slideOutDown',
			__( 'slideOutLeft', 'PixShortcode' ) => 'slideOutLeft',
			__( 'slideOutRight', 'PixShortcode' ) => 'slideOutRight',
			
			__( 'zoomIn', 'PixShortcode' ) => 'zoomIn',
			__( 'zoomInDown', 'PixShortcode' ) => 'zoomInDown',
			__( 'zoomInLeft', 'PixShortcode' ) => 'zoomInLeft',
			__( 'zoomInRight', 'PixShortcode' ) => 'zoomInRight',
			__( 'zoomInUp', 'PixShortcode' ) => 'zoomInUp',			
			__( 'zoomOut', 'PixShortcode' ) => 'zoomOut',
			__( 'zoomOutDown', 'PixShortcode' ) => 'zoomOutDown',
			__( 'zoomOutLeft', 'PixShortcode' ) => 'zoomOutLeft',
			__( 'zoomOutRight', 'PixShortcode' ) => 'zoomOutRight',
			__( 'zoomOutUp', 'PixShortcode' ) => 'zoomOutUp',
			
			__( 'hinge', 'PixShortcode' ) => 'hinge',			
			__( 'rollIn', 'PixShortcode' ) => 'rollIn',
			__( 'rollOut', 'PixShortcode' ) => 'rollOut',
			
		),
		'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'js_composer' )
	);	
	
	$args = array( 'taxonomy' => 'product_cat', 'hide_empty' => '0');
	$categories_woo = get_categories($args);
	$cats_woo = array();
	$i = 0;
	foreach($categories_woo as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats_woo[$category->name] = $category->term_id;
	}
	
	
	if (post_type_exists('portfolio')){
		$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0');
		$categories = get_categories($args);
		$cats = array();
		$i = 0;
		foreach($categories as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->name] = $category->term_id;
		}
		
		
		
		
		vc_map(
			array(
				"name" => __( "Portfolio", "PixShortcode" ),
				"base" => "portfolioblock",
						"class" => "pix-theme-icon",
				"category" => __( "X-Sport", "PixShortcode"),
				"params" => array(				
					array(
						'type' => 'textfield',
						'heading' => __( 'Items Count', 'PixShortcode' ),
						'param_name' => 'count',
						'description' => __( 'Select image from media library.', 'PixShortcode' )
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Categories', 'PixShortcode' ),
						'param_name' => 'cats',
						'value' => $cats,
						'description' => __( 'Select categories to show', 'PixShortcode' )
					),
					$add_css_animation,			
				)
			) 
		);
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			class WPBakeryShortCode_Portfolioblock extends WPBakeryShortCode {
				
			}
		}
		
	}
	
	$pix_libs = $pix_fonts = $pix_fonts_str = $params = $params1 = $params2 = array();
	
if(function_exists('fil_init')){
	
	if( array_key_exists( 'vc_iconpicker-type-pixflaticon' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Flaticon', 'PixTheme' )] = 'pixflaticon';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixfontawesome' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Font Awesome', 'PixTheme' )] = 'pixfontawesome';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixelegant' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Elegant', 'PixTheme' )] = 'pixelegant';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixicomoon' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Icomoon', 'PixTheme' )] = 'pixicomoon';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixsimple' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Simple', 'PixTheme' )] = 'pixsimple';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixcustom1' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Custom 1', 'PixTheme' )] = 'pixcustom1';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixcustom2' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Custom 2', 'PixTheme' )] = 'pixcustom2';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixcustom3' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Custom 3', 'PixTheme' )] = 'pixcustom3';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixcustom4' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Custom 4', 'PixTheme' )] = 'pixcustom4';
	}
	if( array_key_exists( 'vc_iconpicker-type-pixcustom5' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'Custom 5', 'PixTheme' )] = 'pixcustom5';
	}
	if( array_key_exists( 'vc_iconpicker-type-fontawesome' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'VC Font Awesome', 'PixTheme' )] = 'fontawesome';
	}
	if( array_key_exists( 'vc_iconpicker-type-openiconic' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'VC Open Iconic', 'PixTheme' )] = 'openiconic';
	}
	if( array_key_exists( 'vc_iconpicker-type-typicons' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'VC Typicons', 'PixTheme' )] = 'typicons';
	}
	if( array_key_exists( 'vc_iconpicker-type-entypo' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'VC Entypo', 'PixTheme' )] = 'entypo';
	}
	if( array_key_exists( 'vc_iconpicker-type-linecons' , $GLOBALS['wp_filter']) ) {
		$pix_libs[__( 'VC Linecons', 'PixTheme' )] = 'linecons';
	}
	
	$add_icon_libs = array(
		'type' => 'dropdown',
		'heading' => __( 'Icon library', 'PixTheme' ),
		'param_name' => 'type',
		'value' => $pix_libs,
		'admin_label' => true,		
		'description' => __( 'Select icon library.', 'PixTheme' ),
	);
	
	if( is_array($pix_libs) ){
		$pix_fonts_str[] = $add_icon_libs;
		
		foreach( $pix_libs as $val ){
			if($val != '')
			$pix_fonts[$val] = array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'PixTheme' ),
				'param_name' => 'icon_'.$val,
				'value' => '',
				'settings' => array(
					'emptyIcon' => true,
					'type' => $val,
					'iconsPerPage' => 4000,
				),
				'dependency' => array(
					'element' => 'type',
					'value' => $val,
				),
				'description' => __( 'Select icon from library.', 'PixTheme' ),
			);
			$pix_fonts_str[] = $pix_fonts[$val];
		}
	}
	
}
	
	vc_map(
		array(
			"name" => __( "Title Section ", "PixShortcode" ),
			"base" => "tblock",
			"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "I am Title", "PixShortcode" ),
					"description" => __( "Title param.", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Text Before", "PixShortcode" ),
					"param_name" => "before",
					"value" => __( "Title Before", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
			
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	
		vc_map(
		array(
			"name" => __( "Title image ", "PixShortcode" ),
			"base" => "title_image",
			"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "ABOUT THE CLUB", "PixShortcode" ),
					"description" => __( "Title param.", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Text After", "PixShortcode" ),
					"param_name" => "after",
					"value" => __( "XTREME SPORTS CLUB", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
				  array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'js_composer' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'js_composer' )
				),
			
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	
		vc_map(
		array(
			"name" => __( "Title image 2 ", "PixShortcode" ),
			"base" => "title_image2",
			"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "XTREME SPORTS CLUB", "PixShortcode" ),
					"description" => __( "Title param.", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Text Before", "PixShortcode" ),
					"param_name" => "before",
					"value" => __( "WELCOME TO", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
				  array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'js_composer' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'js_composer' )
				),
			
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	
	
	vc_map(
		array(
			"name" => __( "WELCOME TO", "PixShortcode" ),
			"base" => "tblock2",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "XTREME SPORTS CLUB ONLINE SHOP", "PixShortcode" ),
					"description" => __( "Title param.", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Text Before", "PixShortcode" ),
					"param_name" => "before",
					"value" => __( "WELCOME TO", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
			
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>Aenean urna tellus sodales aliquam egestas quis convallis cursus magna. Fusce sa scelerisque. Proin tempor rci vestibulum adipiscing. Etiam blanditd Vestibulum nis Duis nibh dui porttitor eu rhoncus uted. Fusce lacus alc neque interdum pulvinarl Integer vel ante ut. Pellentesque habitant tristique senectus et netus et malesuada fames ac nunc placerat cursus eros. Donec turpis. Nullam porttitor urabitur</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	
	
	
	vc_map(
		array(
			"name" => __( "Sub Title ", "PixShortcode" ),
			"base" => "subtblock",
					"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subtitle", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "Subtitle", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
				
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Oblock extends WPBakeryShortCode {
			
		}
	}	
	
	
	
	
	
	/*vc_map(
		array(
			"name" => __( "State Box", "PixShortcode" ),
			"base" => "state",
					"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "Project", "PixShortcode" ),
					"description" => __( "Title.", "PixShortcode" )
				 ),
				  array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Amount", "PixShortcode" ),
					"param_name" => "amount",
					"value" => __( "999", "PixShortcode" ),
					"description" => __( "Amount.", "PixShortcode" )
				 ),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon", "PixShortcode" ),
					"param_name" => "icon",
					"value" => __( "fa-rocket", "PixShortcode" ),
					"description" => __( "Add icon <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>See all icons</a>", "PixShortcode" )
				 ),
				  array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
				
			)
		) 
	);*/
	
	
	/// featserv
	$params1 = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "I am title", "PixShortcode" ),
					"description" => __( "Add Title ", "PixShortcode" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon", "PixShortcode" ),
					"param_name" => "icon",
					"value" => __( "fa-flag", "PixShortcode" ),
					"description" => __( "Add icon <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font-Awesome</a> or Use theme icons (please check documentation)", "PixShortcode" )
				),
			);
	$params2 = array(
				$add_css_animation,
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Url", "PixShortcode" ),
					"param_name" => "url",
					"value" => __( "https://www.google.by", "PixShortcode" ),
					"description" => __( "Add url", "PixShortcode" )
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", 
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				)
			);
	if(!function_exists('fil_init')){
		$params = array_merge($params1, $params2);
	}else{
		$params = array_merge($params1, $pix_fonts_str, $params2);
	}
	vc_map( 
		array(
			"name" => __( "Featured Services", "PixShortcode" ),
			"base" => "featserv",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => $params,
		)
	);
	
	
	/// featserv2
	$params1 = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "I am title", "PixShortcode" ),
					"description" => __( "Add Title ", "PixShortcode" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon", "PixShortcode" ),
					"param_name" => "icon",
					"value" => __( "fa-flag", "PixShortcode" ),
					"description" => __( "Add icon <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>Font-Awesome</a> or Use theme icons (please check documentation)", "PixShortcode" )
				),
			);
	$params2 = array(
				$add_css_animation,
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", 
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				)
			);
	if(!function_exists('fil_init')){
		$params = array_merge($params1, $params2);
	}else{
		$params = array_merge($params1, $pix_fonts_str, $params2);
	}	
	vc_map( 
		array(
			"name" => __( "Featured Box", "PixShortcode" ),
			"base" => "featserv2",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => $params,
		)
	);
	
	
	
	vc_map(
		array(
			"name" => __( "Brands", "PixShortcode" ),
			"base" => "brandblock",
					"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(				
				 array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'js_composer' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'js_composer' )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "url", "PixShortcode" ),
					"param_name" => "url",
					"value" => __( "https://wordpress.com", "PixShortcode" ), 
					"description" => __( ".", "PixShortcode" )
				)			
			)
		) 
	);
	
	
	vc_map(
		array(
			"name" => __( "Events", "PixShortcode" ),
			"base" => "eventsblock",
			"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(				
				array(
					'type' => 'dropdown',
					'heading' => __( 'Events Count', 'js_composer' ),
					'param_name' => 'count',
					'value' => array(
						1 => 1,
						2 => 2,
						3 => 3,
						4 => 4,
						5 => 5,
						6 => 6
					),
					'description' => __( 'Select image from media library.', 'js_composer' )
				),
				$add_css_animation,			
			)
		) 
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Eventsblock extends WPBakeryShortCode {
			
		}
	}
	
	
	
	vc_map(
		array(
			"name" => __( "Woocommerce Products", "PixShortcode" ),
			"base" => "woocommerceblock",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(	
				array(
						'type' => 'checkbox',
						'heading' => __( 'Categories', 'PixShortcode' ),
						'param_name' => 'cats',
						'value' => $cats_woo,
						'description' => __( 'Select categories to show', 'PixShortcode' )
					),			
				array(
					'type' => 'textfield',
					'heading' => __( 'Products Count', 'PixShortcode' ),
					'param_name' => 'count',
					'value' => 6,
					'description' => __( 'Select image from media library.', 'PixShortcode' )
				),
				$add_css_animation,			
			)
		) 
	);
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Woocommerceblock extends WPBakeryShortCode {
			
		}
	}
	
	
		vc_map(
		array(
			"name" => __( "Title Section", "PixShortcode" ),
			"base" => "tblock",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "I am Title", "PixShortcode" ),
					"description" => __( "Title param.", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Text Before", "PixShortcode" ),
					"param_name" => "before",
					"value" => __( "I am title Before", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Text After", "PixShortcode" ),
					"param_name" => "after",
					"value" => __( "I am test text block. Click edit button to change this text. ", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	vc_map(
		array(
			"name" => __( "Video Box", "PixShortcode" ),
			"base" => "videobox",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				
				 array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'js_composer' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'js_composer' )
				),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Link", "PixShortcode" ),
					"param_name" => "link",
					"value" => __( "https://vimeo.com/88644449", "PixShortcode" ),
					"description" => __( ".", "PixShortcode" )
				 ),$add_css_animation
				 
				
				
			)
		) 
	);
	
	
	
	
	
	vc_map(
		array(
			"name" => __( "Promo Box", "PixShortcode" ),
			"base" => "promo",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
			
				 array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'js_composer' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select image from media library.', 'js_composer' )
				),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Link", "PixShortcode" ),
					"param_name" => "link",
					"value" => __( "", "PixShortcode" ),
					"description" => __( ".", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", "PixShortcode" ),
					"param_name" => "text",
					"value" => __( "SHOP NOW", "PixShortcode" ),
					"description" => __( "", "PixShortcode" )
				 ),
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( "
					  <h3>WATER SPORTS</h3>
                <h4>COLLECTION</h4>
				", "PixShortcode" ),
					"description" => __( "Enter your content.", "PixShortcode" )
				 )
			)
		) 
	);
	
	
	
	
		vc_map(
		array(
			"name" => __( "Banner Box", "PixShortcode" ),
			"base" => "banner",
				"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", "PixShortcode" ),
					"param_name" => "title",
					"value" => __( "SHOP NOW", "PixShortcode" ),
					"description" => __( "Button Title", "PixShortcode" )
				 ),
				 array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Link", "PixShortcode" ),
					"param_name" => "link",
					"value" => __( "https:/templines.com", "PixShortcode" ),
					"description" => __( "Button link", "PixShortcode" )
				 ),
				 $add_css_animation,
				 array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", "PixShortcode" ),
					"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
					"value" => __( " <h4>GET FREE SHIPPING WHEN YOU SPEND JUST $30 OR MORE!</h4>
<h5>WE WILL SHIP YOUR ITEM WITHIN 2 DAYS</h5>", "PixShortcode" ),
					"description" => __( "Banner Text", "PixShortcode" )
				 )
			)
		) 
	);
	
	
	
	
	vc_map(
		array(
			"name" => __( "Post's Grid", "PixShortcode" ),
			"base" => "postsgrid",
					"class" => "pix-theme-icon",
			"category" => __( "X-Sport", "PixShortcode"),
			"params" => array(
				 array(
					'type' => 'textfield',
					'heading' => __( 'Items Count', 'PixShortcode' ),
					'param_name' => 'count',
					'description' => __( 'Select image from media library.', 'PixShortcode' )
				),
			
				$add_css_animation,				 
			)
		) 
	);

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Postsgrid extends WPBakeryShortCode {
			
		}
	}
	
	
	
	vc_map( array(
		'name' => __( 'Brands carousel', 'PixShortcode' ),
		'base' => 'brandscarousel',
				"class" => "pix-theme-icon",
		'as_parent' => array('only' => 'brandblock'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'show_settings_on_create' => true,
		'category' => __( 'X-Sport', 'PixShortcode'), 
		"content_element" => true,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Max slides', 'PixShortcode' ),
				'param_name' => 'max_slides',
				'description' => __( 'Max slides on page. Default 3.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Min slides', 'PixShortcode' ),
				'param_name' => 'min_slides',
				'description' => __( 'Min slides on page. Default 1.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Width slides', 'PixShortcode' ),
				'param_name' => 'width_slides',
				'description' => __( 'Default 380.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Margin slides', 'PixShortcode' ),
				'param_name' => 'margin_slides',
				'description' => __( 'Default 10.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Auto slides', 'PixShortcode' ),
				'param_name' => 'auto_slides',
				'description' => __( 'Default 1. Type 0 to disable auto slides.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Move slides', 'PixShortcode' ),
				'param_name' => 'move_slides',
				'description' => __( 'Number of changing slides. Default 3.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Infinite slides', 'PixShortcode' ),
				'param_name' => 'infinite_slides',
				'description' => __( 'Default 0. Type 1 to infinite slides.', 'PixShortcode' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Disable Carousel', 'PixShortcode' ),
				'param_name' => 'disable_carousel',
				'description' => __( 'Default 1. Type 0 to disable carousel.', 'PixShortcode' )
			),
		),
		'js_view' => 'VcColumnView',
		
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Brandscarousel extends WPBakeryShortCodesContainer {
		}
	}
	
	
	vc_map( array(
		'name' => __( 'Archievements carousel', 'PixShortcode' ),
		'base' => 'archcarousel',
				"class" => "pix-theme-icon",
		'as_parent' => array('only' => 'archcarouselitem'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'show_settings_on_create' => true,
		'category' => __( 'X-Sport', 'PixShortcode'), 
		"content_element" => true,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Disable Carousel', 'PixShortcode' ),
				'param_name' => 'disable_carousel',
				'description' => __( 'Default 1. Type 0 to disable carousel.', 'PixShortcode' )
			),
		),
		'js_view' => 'VcColumnView',
		
	) );
	vc_map( array(
		'name' => __( 'Archievements Info', 'PixShortcode' ),
		'base' => 'archcarouselitem',
				"class" => "pix-theme-icon",
		'as_child' => array('only' => 'archcarousel'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'js_composer' ),
				'param_name' => 'image',
				'description' => __( 'Select image.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Title info.', 'js_composer' )
			),
		
			array(
				'type' => 'textfield',
				'heading' => __( 'Link', 'js_composer' ),
				'param_name' => 'link',
				'description' => __( 'Info link.', 'js_composer' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Info", "PixShortcode" ),
				"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
				"description" => __( "Enter information.", "PixShortcode" )
			),
		)
	) );

	
	
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Archcarousel extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Archcarouselitem extends WPBakeryShortCode {
		}
	}
	
	
	
	
	
	vc_map( array(
		'name' => __( 'Price Table', 'PixShortcode' ),
		'base' => 'pricetable',
		"class" => "pix-theme-icon",
		'as_parent' => array('only' => 'priceitem'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'show_settings_on_create' => true,
		'category' => __( 'X-Sport', 'PixShortcode'), 
		"content_element" => true,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Title info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'More Information', 'js_composer' ),
				'param_name' => 'more',
				'description' => __( 'More Information.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Phone', 'js_composer' ),
				'param_name' => 'phone',
				'description' => __( 'Phone info.', 'js_composer' )
			)
		),
		'js_view' => 'VcColumnView',
		
	) );
	vc_map( array(
		'name' => __( 'Price Table Item', 'PixShortcode' ),
		'base' => 'priceitem',
				"class" => "pix-theme-icon",
		'as_child' => array('only' => 'pricetable'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'js_composer' ),
				'param_name' => 'title',
				'description' => __( 'Title info.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Price', 'js_composer' ),
				'param_name' => 'price',
				'description' => __( 'Price info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Offer #1', 'js_composer' ),
				'param_name' => 'offer1',
				'description' => __( 'Offer info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Offer #2', 'js_composer' ),
				'param_name' => 'offer2',
				'description' => __( 'Offer info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Offer #3', 'js_composer' ),
				'param_name' => 'offer3',
				'description' => __( 'Offer info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Offer #4', 'js_composer' ),
				'param_name' => 'offer4',
				'description' => __( 'Offer info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Offer #5', 'js_composer' ),
				'param_name' => 'offer5',
				'description' => __( 'Offer info.', 'js_composer' )
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Subscripte Text', 'js_composer' ),
				'param_name' => 'subscribe',
				'description' => __( 'Subscripte Text.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Subscribe Link', 'js_composer' ),
				'param_name' => 'subscribe_link',
				'description' => __( 'Subscripte Link.', 'js_composer' )
			),
			
		
		)
	) );
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Pricetable extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Priceitem extends WPBakeryShortCode {
		}
	}
	
	
	
	/////////////////////////////////
	
	
//if(empty($_GET['vc_action'])){
	
	
	//////// About Tabs ////////
	
	
	vc_map( array(
		'name' => __( 'About Tabs', 'PixShortcode' ),
		'base' => 'icontexttabs',
			"class" => "pix-theme-icon",
		'as_parent' => array('only' => 'icontexttab'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => true,
		'category' => __( 'X-Sport', 'PixShortcode'),
		//'front_enqueue_js' => get_template_directory_uri() . '/library/functions/shortcodes/shortcode.js',
		'js_view' => 'VcColumnView', // must be added for all Containers ( or should be extended in js ). VC Dev team
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'PixShortcode' ),
				'param_name' => 'title',
				'description' => __( 'Tab title.', 'PixShortcode' )
			)
		)
	) );
	vc_map( array(
		'name' => __( 'About Tab', 'PixShortcode' ),
		'base' => 'icontexttab',
		'as_child' => array('only' => 'icontexttabs'),
		'content_element' => true,
		//'front_enqueue_js' => get_template_directory_uri() . '/library/functions/shortcodes/shortcode.js',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'PixShortcode' ),
				'param_name' => 'title',
				'description' => __( 'Tab title.', 'PixShortcode' )
			),
			 array(
					'type' => 'attach_image',
					'heading' => __( 'Image', 'js_composer' ),
					'param_name' => 'image',
					'value' => '',
					'description' => __( 'Select autor ', 'js_composer' )
				),
			array(
					'type' => 'attach_image',
					'heading' => __( 'Promo', 'js_composer' ),
					'param_name' => 'promo',
					'value' => '',
					'description' => __( 'Select banner ', 'js_composer' )
				),	
			array(
				'type' => 'textfield',
				'heading' => __( 'Name', 'PixShortcode' ),
				'param_name' => 'name',
				'description' => __( 'Name.', 'PixShortcode' )
			),
				array(
				'type' => 'textfield',
				'heading' => __( 'Position', 'PixShortcode' ),
				'param_name' => 'position',
				'description' => __( 'position.', 'PixShortcode' )
			),
				array(
				'type' => 'textfield',
				'heading' => __( 'Additional', 'PixShortcode' ),
				'param_name' => 'additional',
				'description' => __( 'additional information', 'PixShortcode' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Content", "PixShortcode" ),
				"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
				"description" => __( "Enter your content.", "PixShortcode" )
			 ),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Icontexttabs extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Icontexttab extends WPBakeryShortCode {
		}
	}
	//////////////////////////////////
	
	
	//////// Carousel Content ////////
	vc_map( array(
		'name' => __( 'Staff Carousel', 'PixShortcode' ),
		'base' => 'caurusel_content',
				"class" => "pix-theme-icon",
		'as_parent' => array('only' => 'caurusel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => false,
		'category' => __( 'X-Sport', 'PixShortcode'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Carousel title', 'PixShortcode' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as caurusel title. Leave blank if no title is needed.', 'PixShortcode' )
			)
		),
		'js_view' => 'VcColumnView',
		
	) );
	vc_map( array(
		'name' => __( 'Staff item', 'PixShortcode' ),
		'base' => 'caurusel_item',
				"class" => "pix-theme-icon",
		'as_child' => array('only' => 'caurusel_content'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => __( 'Avatar', 'js_composer' ),
				'param_name' => 'avatar',
				'description' => __( 'Select image', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Name', 'js_composer' ),
				'param_name' => 'name'
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Postition', 'js_composer' ),
				'param_name' => 'postition',
				'description' => __( 'Postition title.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Link 1', 'js_composer' ),
				'param_name' => 'scn1',
				'description' => __( 'https://www.facebook.com/', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Network Icon 1', 'js_composer' ),
				'param_name' => 'scn_icon1',
				'description' => __( 'Add icon fa-facebook <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Link 2', 'js_composer' ),
				'param_name' => 'scn2',
				'description' => __( 'https://twitter.com/', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Network Icon 2', 'js_composer' ),
				'param_name' => 'scn_icon2',
				'description' => __( 'Add icon fa-twitter <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Link 3', 'js_composer' ),
				'param_name' => 'scn3',
				'description' => __( 'https://plus.google.com/', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Network Icon 3', 'js_composer' ),
				'param_name' => 'scn_icon3',
				'description' => __( 'Add icon fa-google-plus <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Link 4', 'js_composer' ),
				'param_name' => 'scn4',
				'description' => __( 'http://www.w3.org/TR/html5/', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Network Icon 4', 'js_composer' ),
				'param_name' => 'scn_icon4',
				'description' => __( 'Add icon fa-html5 <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Link 5', 'js_composer' ),
				'param_name' => 'scn5',
				'description' => __( 'https://github.com/', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Social Network Icon 5', 'js_composer' ),
				'param_name' => 'scn_icon5',
				'description' => __( 'Add icon fa-github <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">See all icons</a>', 'js_composer' )
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Short description", "PixShortcode" ),
				"param_name" => "short_desc", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "I am test text block. Click edit button to change this text.", "PixShortcode" ),
				"description" => __( "Enter your content.", "PixShortcode" )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Full Description", "PixShortcode" ),
				"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
				"description" => __( "Enter your full description.", "PixShortcode" )
			),
		)
	) );
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Caurusel_Content extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Caurusel_Item extends WPBakeryShortCode {
		}
	}
	/////////////////////////////////
	
	//////// Carousel Reviews ////////
	vc_map( array(
		'name' => __( 'Carousel Reviews', 'PixShortcode' ),
		'base' => 'caurusel_reviews',
				"class" => "pix-theme-icon",
		'as_parent' => array('only' => 'caurusel_review'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		'content_element' => true,
		'show_settings_on_create' => false,
		'category' => __( 'X-Sport', 'PixShortcode'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Carousel title', 'PixShortcode' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as caurusel title. Leave blank if no title is needed.', 'PixShortcode' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Enable Carousel', 'PixShortcode' ),
				'param_name' => 'is_carousel',
				'value' => array("Yes" , "No"),
				'description' => __( 'Select reviews display type', 'PixShortcode' )
			)
		),
		'js_view' => 'VcColumnView',
		
	) );
	vc_map( array(
		'name' => __( 'Review', 'PixShortcode' ),
		'base' => 'caurusel_review',
				"class" => "pix-theme-icon",
		'as_child' => array('only' => 'caurusel_reviews'),
		'content_element' => true,
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => __( 'Avatar', 'js_composer' ),
				'param_name' => 'avatar',
				'description' => __( 'Accordion section title.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Name', 'js_composer' ),
				'param_name' => 'name',
				'description' => __( 'Accordion section title.', 'js_composer' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Postition', 'js_composer' ),
				'param_name' => 'postition',
				'description' => __( 'Accordion section title.', 'js_composer' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Full Description", "PixShortcode" ),
				"param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
				"value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "PixShortcode" ),
				"description" => __( "Enter your full description.", "PixShortcode" )
			),
		)
	) );
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_Caurusel_Reviews extends WPBakeryShortCodesContainer {
		}
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_Caurusel_Review extends WPBakeryShortCode {
		}
	}

//} ////// <= End vc_inline


$attributes = array(
	array(
		'type' => 'attach_images',
		'heading' => __( 'Background Slides', 'js_composer' ),
		'param_name' => 'pbgslides',
		'description' => __( 'Background Slides.', 'js_composer' )
	),
	array(
	    'type' => 'dropdown',
	    'heading' => "Page Decor",
	    'param_name' => 'pdecor',
	    'value' => array("None" , "Top", "Bottom", "Both" ),
	    'description' => __( "Page Decor Option", "PixShortcode" )
	),
	array(
	    'type' => 'dropdown',
	    'heading' => "Text Color",
	    'param_name' => 'ptextcolor',
	    'value' => array("Default" , "White" , "Black"),
	    'description' => __( "Text Color", "PixShortcode" )
	),
	
);
vc_add_params( 'vc_row', $attributes );
	
}

