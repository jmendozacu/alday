<?php 

//add_action('admin_init','initAdminOptions');

/**** THEME SETTINGS ***/
/*function initAdminOptions(){
		
	global $shortname,$options;	*/
		
	$args = array(
		'post_type'        => 'staticblocks',
		'post_status'      => 'publish',
	);
	$staticBlocks = array();
	$staticBlocksData = get_posts( $args );
	foreach($staticBlocksData as $_block){
		$staticBlocks[] = array( "value" => $_block->ID, "text" => $_block->post_title);
	}	
	
	
	global $wp_registered_sidebars;
	
	
	
	$_sidebars = array();
	
	$sidebars = $wp_registered_sidebars;
	if(is_array($sidebars) && !empty($sidebars)){
		foreach($sidebars as $sidebar){
			$_sidebars[] = array('value' => esc_attr($sidebar['id']),'text' => $sidebar['name']);
		}
	}
	
	//var_dump($sidebars);die;
				
					
		
	$options = array(
		
		array(
			'type' => 'open',
			'tab_name' => 'General settings',
			'tab_id' => 'general-settings'
		) ,
		
		/*array(
			'name' => 'Import Demo Content',
			'id' => $shortname . '_importdemocontent',
			'type' => 'button',
			'std' => 'Import Demo Content',
			'action' => 'pixImportDemoContent(this)',
			'desc' => 'Import Demo Content ( Pages etc. )'
		),*/
		
		array(
			'name' => 'Color Theme',
			'id' => $shortname . '_color_theme',
			'type' => 'select',
			'desc' => 'Select color theme',
			'options' => array(
				array( "value" => "color1", "text" => "Skin 1"),	
				array( "value" => "color2", "text" => "Skin 2"),			
				array( "value" => "color3", "text" => "Skin 3"),
				array( "value" => "color4", "text" => "Skin 4"),
				array( "value" => "color5", "text" => "Skin 5"),
				array( "value" => "color6", "text" => "Skin 6"),
			)		
		) ,
		
		array(
			'name' => 'Logo image',
			'id' => $shortname . '_logo',
			'type' => 'upload',
			'img_w' => '400',
			'img_h' => '250',
			'std' => '',
			'desc' => 'Upload a logo from your hard drive or specify an existing url (Recommended size: 290x88)'
		),	
	
		array(
			'name' => 'Logo Text',
			'id' => $shortname . '_logotext',
			'type' => 'text',
			'std' => '',
			'desc' => 'Logo Image alt text'
		) ,
		
		array(
			'name' => 'Favicon',
			'id' => $shortname . '_favicon',
			'type' => 'upload',
			'img_w' => '400',
			'img_h' => '250',
			'std' => '',
			'desc' => 'Upload a favicon.'
		),
				
		array(
			'name' => 'Header image',
			'id' => $shortname . '_header_img',
			'type' => 'upload',
			'img_w' => '1600',
			'img_h' => '140',
			'std' => '',
			'desc' => 'Upload an image from your hard drive or specify an existing url (Recommended size: 1600x140)'
		),	
		
		array(
			'name' => 'Loader',
			'id' => $shortname . '_loader',
			'type' => 'select',
			'desc' => 'Choose loader use',
			'options' => array(
				array( "value" => "0", "text" => "Off"),
				array( "value" => "1", "text" => "Use on main"),
				array( "value" => "2", "text" => "Use on all pages")		
			)		
		) ,
		
		array(
			'name' => 'Responsive',
			'id' => $shortname . '_responsive',
			'type' => 'select',
			'desc' => 'Choose responsive use',
			'options' => array(
				array( "value" => "1", "text" => "On"),	
				array( "value" => "0", "text" => "Off")			
			)		
		) ,
		
		array(
			'name' => 'Color Swatcher',
			'id' => $shortname . '_show_color_selector',
			'type' => 'select',
			'desc' => 'Show theme color swatcher on frontend',
			'options' => array(
				array( "value" => "0", "text" => "Off"),	
				array( "value" => "1", "text" => "On")			
			)		
		) ,
		
		array(
			'name' => 'Menu Sidebar',
			'id' => $shortname . '_show_menu_sidebar',
			'type' => 'select',
			'desc' => 'Show left menu sidebar on frontend',
			'options' => array(
				array( "value" => "0", "text" => "Off"),	
				array( "value" => "1", "text" => "On")			
			)		
		) ,
		
		array(
			'name' => 'Events Page Title',
			'id' => $shortname . '_evtpagetitle', 
			'type' => 'text',
			'std' => '',
			'desc' => 'Events Page Title'
		) ,
		
		
		
		
		array(
			'type' => 'close'
		) ,
		
		/*************** Portfolio ***************/
		array(
			'type' => 'open',
			'tab_name' => 'Portfolio Settings',
			'tab_id' => 'portfolio-settings'
		) ,
	    
		array(
			'name' => 'Tumbnails Width',
			'id' => $shortname . '_portfolio_width',
			'type' => 'text',
			'std' => '800',
			'desc' => 'Recomended 800px'
		) ,
		
		array(
			'name' => 'Tumbnails Height',
			'id' => $shortname . '_portfolio_height',
			'type' => 'text',
			'std' => '500',
			'desc' => 'Recomended 500px'
		) ,
		
		array(
			'type' => 'close'
		) ,
	    
	    /*****************************************/
		
		/*************** Woocommerce ***************/
		array(
			'type' => 'open',
			'tab_name' => 'Woocommerce',
			'tab_id' => 'woocommerce-settings'
		) ,
	    
		array(
			'name' => 'Related Products',
			'id' => $shortname . '_pelated_products',
			'type' => 'text',
			'std' => '6',
			'desc' => 'Related products per page'
		) ,
		
		array(
			'name' => 'Related Products Logo Image',
			'id' => $shortname . '_pelated_products_logo',
			'type' => 'upload',
			'img_w' => '400',
			'img_h' => '250',
			'std' => 'img/logo-black.png',
			'desc' => 'Upload a logo from your hard drive or specify an existing url'		
		) ,
		
		
		array(
			'name' => 'Default view on product listing',
			'id' => $shortname . '_category_view',
			'type' => 'select',
			'options' => array(
				array( "value" => "0", "text" => "Grid"),
				array( "value" => "1", "text" => "List")
			),
			'desc' => 'Grid or List view'
		) ,
		
		array(
			'name' => 'Show OutOfStock Label',
			'id' => $shortname . '_show_oos_label',
			'type' => 'select',
			'options' => array(
				array( "value" => "0", "text" => "No"),
				array( "value" => "1", "text" => "Yes")
			),
			'desc' => 'Show OutOfStock Label'
		) ,		
		
		
		array(
			'name' => 'Show Bestseller Label',
			'id' => $shortname . '_show_best_label',
			'type' => 'select',
			'options' => array(
				array( "value" => "0", "text" => "No"),
				array( "value" => "1", "text" => "Yes")
			),
			'desc' => 'Show Bestseller Label'
		) ,
		
		array(
			'name' => 'Label Bestseller Sales',
			'id' => $shortname . '_min_best_sales',
			'type' => 'text',
			'std' => '5',
			'desc' => 'Minimum sales for the bestseller'
		) ,
		
		array(
			'name' => 'Show New Label',
			'id' => $shortname . '_show_new_label',
			'type' => 'select',
			'options' => array(
				array( "value" => "0", "text" => "No"),
				array( "value" => "1", "text" => "Yes")
			),
			'desc' => 'Show New Label'
		) ,	
		
		array(
			'name' => 'Label New Sales',
			'id' => $shortname . '_how_new',
			'type' => 'text',
			'std' => '5',
			'desc' => 'How many days as a new product?'
		) ,
		
		array(
			'name' => 'Use global product settings',
			'id' => $shortname . '_use_product_global',
			'type' => 'select',
			'options' => array(
				array( "value" => "0", "text" => "No"),
				array( "value" => "1", "text" => "Yes")
			),
			'desc' => 'Use global product settings'
		) ,	
		
		array(
			'name' => 'Sidebar Type on Product Page',
			'id' => $shortname . '_ppage_sidebar_type',
			'type' => 'select',
			'options' => array(
				array( "value" => "1", "text" => "Full width"),
				array( "value" => "3", "text" => "Left"),
				array( "value" => "2", "text" => "Right"),			
			),
			'desc' => 'Sidebar Type on Product Page'
		) ,	
		
		array(
			'name' => 'Sidebar Content on Product Page',
			'id' => $shortname . '_ppage_sidebar_content',
			'type' => 'select',
			'options' => $_sidebars,
			'desc' => 'Sidebar Content on Product Page'
		) ,	
	
		
		array(
			'type' => 'close'
		) ,
	    
	    /*****************************************/
		
		/*************** Customer ***************
		array(
			'type' => 'open',
			'tab_name' => 'Seller Settings',
			'tab_id' => 'seller-settings'
		) ,
				
		array(
			'name' => 'Envato Username',
			'id' => $shortname . '_envato_id',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'Envato Profile URL',
			'id' => $shortname . '_envato_url',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'Envato API Key',
			'id' => $shortname . '_envato_api',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'Select Envato Marketplaces from where you want to show your products in all products page',
			'id' => $shortname . '_seller_networks',
			'type' => 'toggle',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'Themeforest',
			'id' => $shortname . '_envato_themeforest',
			'type' => 'checkbox',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'Codecanyon',
			'id' => $shortname . '_envato_codecanyon',
			'type' => 'checkbox',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'Graphicriver',
			'id' => $shortname . '_envato_graphicriver',
			'type' => 'checkbox',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'ActiveDen',
			'id' => $shortname . '_envato_activeden',
			'type' => 'checkbox',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'VideoHive',
			'id' => $shortname . '_envato_videohive',
			'type' => 'checkbox',
			'std' => '',
			'desc' => ''
		) ,
		
		array(
			'name' => 'AudioJungle',
			'id' => $shortname . '_envato_audiojungle',
			'type' => 'checkbox',
			'std' => '',
			'desc' => ''
		) ,
	    
		array(
			'name' => 'Tumbnails Width',
			'id' => $shortname . '_envato_width',
			'type' => 'text',
			'std' => '366',
			'desc' => 'Recomended 366px'
		) ,
		
		array(
			'name' => 'Tumbnails Height',
			'id' => $shortname . '_envato_height',
			'type' => 'text',
			'std' => '186',
			'desc' => 'Recomended 186px'
		) ,
		
		array(
			'type' => 'close'
		) ,
	    
	  
	    
	    
	    /*****************************************/
	    
	    
	    /*************** HEADER ***************/
		array(
			'type' => 'open',
			'tab_name' => 'Header',
			'tab_id' => 'header-section'
		) ,
		array( 
			"name" => "Header Type",
			"desc" => "Select header type.",
			"id" => $shortname."_header_type",
			"type" => "select",
			'options' => array(
				array( "value" => "pix-header1", "text" => "Header #1"),
				array( "value" => "pix-header2", "text" => "Header #2")
			)
		),
		
		/*array(
			'name' => 'Header #2 Extend Logo',
			'id' => $shortname . '_header2_logo',
			'type' => 'upload',
			'img_w' => '400',
			'img_h' => '250',
			'std' => '',
			'desc' => 'Upload a logo from your hard drive or specify an existing url (Recommended size: 290x88)'
		),*/
		
		array(
			'name' => 'Header Text',
			'id' => $shortname . '_header_text_1',
			'type' => 'text',
			'std' => '24/7 SUPPORT',
			'desc' => 'Header text'
		),
		
		array(
			'name' => 'Header Phone',
			'id' => $shortname . '_header_phone',
			'type' => 'text',
			'std' => '0800 123 4567',
			'desc' => 'Header phone'
		),
		
		array(
			'name' => 'Header Phone Link',
			'id' => $shortname . '_header_phone_link',
			'type' => 'text',
			'std' => '',
			'desc' => 'Header phone link'
		),
		
		
		
		array(
			'item_name' => 'Icon #1',
			'type' => 'toggle',
		) ,
			array(
				'name' => 'Icon',
				'id' => $shortname . '_header_ilt_1_icon',
				'type' => 'text',
				'desc' => 'ex. fa-truck'
			) ,
			array(
				'name' => 'Title',
				'id' => $shortname . '_header_ilt_1_title',
				'type' => 'text',
				'desc' => ''
			) ,
			array(
				'name' => 'Content',
				'id' => $shortname . '_header_ilt_1_text',
				'type' => 'textarea',
				'std' => '',
				'desc' => ''
			) ,
			array(
				'name' => 'Link',
				'id' => $shortname . '_header_ilt_1_link',
				'type' => 'text',
				'desc' => ''
			) ,
		array(
			'type' => 'toggle_close',
		) ,
		
		array(
			'item_name' => 'Icon #2',
			'type' => 'toggle',
		) ,
			array(
				'name' => 'Icon',
				'id' => $shortname . '_header_ilt_2_icon',
				'type' => 'text',
				'desc' => 'ex. fa-truck'
			) ,
			array(
				'name' => 'Title',
				'id' => $shortname . '_header_ilt_2_title',
				'type' => 'text',
				'desc' => ''
			) ,
			array(
				'name' => 'Content',
				'id' => $shortname . '_header_ilt_2_text',
				'type' => 'textarea',
				'std' => '',
				'desc' => ''
			) ,
			array(
				'name' => 'Link',
				'id' => $shortname . '_header_ilt_2_link',
				'type' => 'text',
				'desc' => ''
			) ,
		array(
			'type' => 'toggle_close',
		) ,
		
		array(
			'item_name' => 'Icon #3',
			'type' => 'toggle',
		) ,
			array(
				'name' => 'Icon',
				'id' => $shortname . '_header_ilt_3_icon',
				'type' => 'text',
				'desc' => 'ex. fa-truck'
			) ,
			array(
				'name' => 'Title',
				'id' => $shortname . '_header_ilt_3_title',
				'type' => 'text',
				'desc' => ''
			) ,
			array(
				'name' => 'Content',
				'id' => $shortname . '_header_ilt_3_text',
				'type' => 'textarea',
				'desc' => '',
				'std' => ''
			) ,
			array(
				'name' => 'Link',
				'id' => $shortname . '_header_ilt_3_link',
				'type' => 'text',
				'desc' => ''
			) ,
		array(
			'type' => 'toggle_close',
		) ,
		array(
				'name' => 'Show minicart Icon',
				'id' => $shortname . '_header_minicart',
				'type' => 'checkbox',
				'desc' => '',
				//'default' => true
			) ,
		array(
				'name' => 'Show Search by category',
				'id' => $shortname . '_header_catsearch',
				'type' => 'checkbox',
				'desc' => '',
				//'default' => true
			) ,
		
	    	
		array(
			'type' => 'close'
		) ,
	    /*****************************************/
	    
	    
			
		/*************** FOOTER ***************/
		array(
			'type' => 'open',
			'tab_name' => 'Footer',
			'tab_id' => 'footer-section'
		) ,
		
		array(
			'name' => 'StaticBlock',
			'id' => $shortname . '_footer_staticblock',
			'type' => 'select',
			'desc' => 'Choose staticblock to use',
			'options' => $staticBlocks		
				
		) ,
	    	
		array(
			'type' => 'close'
		) ,
	    /*****************************************/
		
		
		
		/*******************  BLOG  ******************/
		array(
			'type' => 'open',
			'tab_name' => 'Blog',
			'tab_id' => 'blog'
		) ,
				
		array( 
			"name" => "Read More text",
			"desc" => "Caption of permalink buttons in blog listing",
			"id" => $shortname."_blogreadmore",
			"type" => "text",
			"std" => "Read More"
		),
		
		array( 
			"name" => "Show date",
			"desc" => "Date on blog posts listing page.",
			"id" => $shortname."_blog_show_date",
			"type" => "select",
			'options' => array(
				array( "value" => "1", "text" => "Yes"),
				array( "value" => "0", "text" => "No")
			)
		),
		
		array( 
			"name" => "Show Comments count",
			"desc" => "Comments amount on blog posts listing page.",
			"id" => $shortname."_blog_show_comments",
			"type" => "select",
			'options' => array(
				array( "value" => "1", "text" => "Yes"),
				array( "value" => "0", "text" => "No")
			)
		),
		
		array( "type" => "close"),
		/*********************************************/
			
		/**************  SOCIAL  ***************/
		/*array(
			'type' => 'open',
			'tab_name' => 'Social',
			'tab_id' => 'social'
		) ,
		
		array(
			'name' => 'Facebook',
			'id' => $shortname . '_facebook',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'VK',
			'id' => $shortname . '_vk',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Youtube',
			'id' => $shortname . '_youtube',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Vimeo',
			'id' => $shortname . '_vimeo',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Twitter',
			'id' => $shortname . '_twitter',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Google+',
			'id' => $shortname . '_google',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Tumblr',
			'id' => $shortname . '_tumblr',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Wordpress',
			'id' => $shortname . '_wordpress',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Instagram',
			'id' => $shortname . '_instagram',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		array(
			'name' => 'Pinterest',
			'id' => $shortname . '_pinterest',
			'type' => 'text',
			'std' => '',
			'desc' => ''
		) ,
		
		
		array(
			'type' => 'close'
		) ,*/
		/*****************************************************/	
		
		
		/**************  Miscellaneous  ***************/
		array(
			'type' => 'open',
			'tab_name' => 'Custom CSS / JS',
			'tab_id' => 'misc'
		) ,
			array(
				'name' => 'Custom CSS',
				'id' => $shortname.'_custom_css',
				'type' => 'textarea',
				'std' => '',
				'desc' => 'Add any custom css here. It will override the default values and will not be overwritten when the theme is updated. <br /> e.g.; .region1wrap{background:#000}'
			),
			
			/*array(
				'name' => 'Custom JS',
				'id' => $shortname.'_custom_js',
				'type' => 'textarea',
				'std' => '',
				'desc' => 'Add any custom javascript code, like Google Analytics, here.'
			),*/
	
		array(
			'type' => 'close'
		) ,
		/*****************************************************/	
	);
	//}
?>