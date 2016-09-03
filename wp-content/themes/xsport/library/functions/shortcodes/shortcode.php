<?php
define ( 'JS_PATH' , get_template_directory_uri().'/library/functions/shortcodes/shortcode.js');

$GLOBALS['icontext_count']=0;
$GLOBALS['icontext_active_count']=0;
$GLOBALS['icontexts']='';
$GLOBALS['caurusel_count']=0;
$GLOBALS['caurusel_items']='';
$GLOBALS['review_count']=0;
$GLOBALS['reviews']='';

add_action('admin_head','html_quicktags');
function html_quicktags() {

	$output = "<script type='text/javascript'>\n
	/* <![CDATA[ */ \n";
	wp_print_scripts( 'quicktags' );


	
	$buttons[] = array(
		'name' => 'thin_title',
		'options' => array(
			'display_name' => 'thin_title',
			'open_tag' => '\n[thin_title]',
			'close_tag' => '[/thin_title]\n',
			'key' => ''
	));


	
	$buttons[] = array(
		'name' => 'btn_icon',
		'options' => array(
			'display_name' => 'btn_icon',
			'open_tag' => '\n[btn_icon  link="http://google.com"  type="right"]',
			'close_tag' => '[/btn_icon]\n',
			'key' => ''
	));
	
	
	
	
	$buttons[] = array(
		'name' => 'icon_box',
		'options' => array(
			'display_name' => 'icon_box',
			'open_tag' => '\n[icon_box  icon="fa-flag"  type="fa-2x"]',
			'close_tag' => '[/icon_box]\n',
			'key' => ''
	));
	
	
	
	$buttons[] = array(
		'name' => 'icon_box_contact',
		'options' => array(
			'display_name' => 'icon_box_contact',
			'open_tag' => '\n[icon_box_contact  icon="fa-home"  type="fa-2x"]',
			'close_tag' => '[/icon_box_contact]\n',
			'key' => ''
	));
	
	
	
	
	
	
	
	$buttons[] = array(
		'name' => 'marked_list1',
		'options' => array(
			'display_name' => 'marked_list1',
			'open_tag' => '\n[marked_list1]',
			'close_tag' => '[/marked_list1]\n',
			'key' => ''
	));
	
	
	$buttons[] = array(
		'name' => 'marked_list2',
		'options' => array(
			'display_name' => 'marked_list2',
			'open_tag' => '\n[marked_list2]',
			'close_tag' => '[/marked_list2]\n',
			'key' => ''
	));

			
	for ($i=0; $i <= (count($buttons)-1); $i++) {
		$output .= "edButtons[edButtons.length] = new edButton('ed_{$buttons[$i]['name']}'
			,'{$buttons[$i]['options']['display_name']}'
			,'{$buttons[$i]['options']['open_tag']}'
			,'{$buttons[$i]['options']['close_tag']}'
			,'{$buttons[$i]['options']['key']}'
		); \n";
	}
	
	$output .= "\n /* ]]> */ \n
	</script>";
	echo $output;
}
	

function pixtheme_addbuttons() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_pix_custom_tinymce_plugin");
		add_filter('mce_buttons_3', 'register_pix_custom_button');
	}
}
function register_pix_custom_button($buttons) {
	array_push(
		$buttons,
		"title_block",
		"title_image",
		"thin_title",
		"icon_box_contact",
	   "banner",
		"content_block",
		"VideoBox",
		"FeatServ",
		"FeatServ2",
		"DealPanel",
		"ReviewsPanel",
		"Progress",
		"AddButton",
		"Dropdown",
		"Tabs",
		"fTabs",
		"AboutTabs",
		"Toggle",
		"Accordion",
		"Testimonial",
		"btn_icon",
		"Banner",
		"Carousel",
		"Contact",
		"Fblock",
		"Tblock",
		"Offerblock",
		"BrandBlock",
		"hexagon",
		"state"
		
		); 
	return $buttons;
} 
function add_pix_custom_tinymce_plugin($plugin_array) {
	$plugin_array['PixThemeShortcodes'] = JS_PATH;
	return $plugin_array;
}
add_action('init', 'pixtheme_addbuttons');






/******************* thin_title *******************/

function alc_thin_title( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"title"=>''
	), $atts));	
	$out = '<h2 class="light-font">'.$content.'</h2>';
   return $out;
}
add_shortcode('thin_title', 'alc_thin_title');



/******************* btn_icon *******************/

function alc_btn_icon( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"link"=>'',
		"type"=>''
	), $atts));	
	$out = '<div class="btn-icon-wrap"><a href="'.$link.'" class="btn  btn-primary btn-icon-'.$type.' ">'.$content.'
          <div class="btn-icon"><i class="fa fa-long-arrow-'.$type.'"></i> </div>
          </a></div>';
   return $out;
}
add_shortcode('btn_icon', 'alc_btn_icon');



/******************* icon_box *******************/

function alc_icon_box( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"icon"=>'',
		"type"=>''
	), $atts));	
	$out = '<span class="icon_box_wrap"><i class="fa '.$icon.'  '.$type.'"></i></span>';
   return $out;
}
add_shortcode('icon_box', 'alc_icon_box');





/******************* icon_box_contact*******************/

function alc_icon_box_contact( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"icon"=>'',
		"type"=>''
	), $atts));	
	$out = '
	
	<div class="media fot-contact">
            <div class="media-left"> <i class="fa '.$icon.'  '.$type.'"></i></div>
            <div class="media-body">
            '.$content.'
            </div>
          </div>';
   return $out;
}
add_shortcode('icon_box_contact', 'alc_icon_box_contact');


/******************* marked_list1 *******************/

function alc_marked_list1( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"icon"=>'',
		"type"=>''
	), $atts));	
	$out = '<div class="marked_list1">'.$content.'</div>';
   return $out;
}
add_shortcode('marked_list1', 'alc_marked_list1');


/******************* marked_list2 *******************/

function alc_marked_list2( $atts, $content = null ) {
     extract(shortcode_atts(array(
		"icon"=>'',
		"type"=>''
	), $atts));	
	$out = '<div class="marked_list12">'.$content.'</div>';
   return $out;
}
add_shortcode('marked_list2', 'alc_marked_list2');


/********************* TITLE BLOCK**********************/

function pixtheme_title_block( $atts, $content = null ) {
   return '
   <h4 class="title_block"><span>' . do_shortcode($content) . '</span></h4>';
}
add_shortcode('title_block', 'pixtheme_title_block');

function pixtheme_content_block( $atts, $content = null ) {
   return '<div class="content_block">' . do_shortcode($content) . '</div>';
}
add_shortcode('content_block', 'pixtheme_content_block');





		  
	
/********************* VC TITLE IMAGE **********************/

function pix_title_image( $atts, $content = null ) {
	$out = $image = '';
 extract(shortcode_atts(array(
		"title" => '',
		"image" => $image,
		"after" => '',
		'css_animation' => ''
	), $atts));	
	
	$img = wp_get_attachment_image_src( $image, 'large' );
		
	$img_output = $img[0];
	
		$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
	$out .= '
	
	<div class="row">
      <div class="col-lg-12 text-center">
	  
	  
        <div  class="heading-wrap">
          <div class="small-logo"><img src="'.esc_url($img_output).'" alt="'.$title.'"></div>';
	   
    $out .=      '<h2 class="section-heading">'.$title.'</h2>';

    if (strlen($after)) $out .= '<h3 class="section-subheading hang">'.$after.'</h3>';
    $out .= '</div>
      </div>
    </div>';
	
    if (strlen($content)) $out .= '<div class="text-center after-title-info">   '.do_shortcode($content).'  </div>';
		
  	$out .= $css_animation != '' ? '</div>' : '';
    return $out;		
}

add_shortcode('title_image', 'pix_title_image');

/**************************************************/	  

	
		  
	
/********************* VC TITLE IMAGE 2 **********************/

function pix_title_image2( $atts, $content = null ) {
	$out = $image = '';
 extract(shortcode_atts(array(
		"title" => '',
		"image" => $image,
		"before" => '',
		'css_animation' => ''
	), $atts));	
	
	$img = wp_get_attachment_image_src( $image, 'large' );
		
	$img_output = $img[0];
	
	$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
	$out .= '
	
	<div class="row">
      <div class="col-lg-12 text-center">
        <div  class="heading-wrap">
          <div class="small-logo"><img width="106" height="36" src="'.esc_url($img_output).'" alt="'.$title.'"></div>
		  
          <h2 class="section-subheading-simple">'.$before.'</h2>'; 
          
    if (strlen($title)) $out .= '<h3 class=" section-heading">'.$title.'</h3>';
    $out .= '</div>
      </div>
    </div>';
	
    if (strlen($content)) $out .= '<div class="text-center after-title-info">   '.do_shortcode($content).'  </div>';
		
	$out .= $css_animation != '' ? '</div>' : '';
    return $out;	
}

add_shortcode('title_image2', 'pix_title_image2');

/**************************************************/	  	  
	
/********************* VC PROMO **********************/

function pix_promo( $atts, $content = null ) {
	$out = $image = '';
 extract(shortcode_atts(array(
		"title" => '',
		"image" => $image,
		"link" => '',
		"text" => '',
		'css_animation' => ''
	), $atts));	
	
	$img = wp_get_attachment_image_src( $image, 'large' );
		
	$img_output = $img[0];
$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';	
	$out .= '
	
	
<div class="promo-item">
            <div class="overlay-promo"><a class="btn" href="'.esc_url($link).'" >'.$text.'</a></div>
            <a href="'.esc_url($link).'"><img src="'.esc_url($img_output).'"></a>
            <div class="promo-caption">
              <div class="promo-content">
               '.do_shortcode($content).'
              </div>
            </div>
          </div>
	
	';
	$out .= $css_animation != '' ? '</div>' : '';		
    return $out;	
}

add_shortcode('promo', 'pix_promo');

/**************************************************/	  


/********************* VC VIDEO BOX **********************/

function pix_videobox( $atts, $content = null ) {
	$out = $image = '';
 extract(shortcode_atts(array(
		"title" => '',
		"image" => $image,
		"link" => '',
		"text" => '',
		'css_animation' => ''
	), $atts));	
	
	$img = wp_get_attachment_image_src( $image, 'large' );
		
	$img_output = $img[0];
	$out .= $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
	$out = '
	
	
	<div class="row">
      <div class="col-lg-6"> </div>
      <div class="col-lg-6">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <a class="video-popab" href="'.esc_url($link).'"> <img src="'.esc_url($img_output).'" ></a>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>
    </div>
	
	
	';
	$out .= $css_animation != '' ? '</div>' : '';		
    return $out;	
}

add_shortcode('videobox', 'pix_videobox');

/**************************************************/







/********************* VC BANNER BOX **********************/

function pix_banner( $atts, $content = null ) {
	$out = $image = '';
 extract(shortcode_atts(array(
		"title" => '',
		
		"link" => '',
		'css_animation' => ''
	), $atts));	
	
	$img = wp_get_attachment_image_src( $image, 'large' );
		
	$img_output = $img[0];
	$out .= $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
	$out .= '
	
	
	<div class="banner-full-width primary-color" id="banner01">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-right">
       '.do_shortcode($content).'
      </div>
      <div class="col-lg-2 text-left"> <a href="'.esc_url($link).'" class="btn btn-default">'.$title.'</a>  </div>
      <div class="col-lg-2 text-right"></div>
    </div>
  </div>
</div>

	


	';
	$out .= $css_animation != '' ? '</div>' : '';		
    return $out;	
}

add_shortcode('banner', 'pix_banner');

/**************************************************/



/********************* VC FEATURED SERVICES **********************/

function pix_featserv( $atts, $content = null ) {
 extract(shortcode_atts(array(
        "url" => '',
		"title" => '',
		"icon" => '',
		'css_animation' => ''
	), $atts));	
	
	$out = '';
	$finaltitle = ($title == '') ? '': ' <h4 class="service-heading">'.$title.'</h4>';
	$finallicon = ($icon == '') ? '': '<i class="fa '.esc_attr($icon).'"></i>';
	$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';	
	$out .= '
	
	<div  class="service-item text-center">
          <a href="'.$url.'"  class="service-icon"> '.$finallicon.'</a>
         	'.$finaltitle.'

	'.do_shortcode($content).'
	</div>'; 
    $out .= $css_animation != '' ? '</div>' : '';		
    return $out;	
}

add_shortcode('featserv', 'pix_featserv');

/**************************************************/







/********************* VC FEATURED SERVICES 2 **********************/

function pix_featserv2( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"title" => '',
		"icon" => '',
		'css_animation' => '',
	), $atts));	
	
	$out = '';
	$finaltitle = ($title == '') ? '': '<h4 class="sub-title  text-left">'.$title.'</h4>';
	$finallicon = ($icon == '') ? '': '<i class="fa '.esc_attr($icon).'"></i>';
	$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';	

	$out .= '
	
	<div class="ft-box text-center">
          <div class="ft-icon-box "> '.$finallicon.'</div>
          <hr style="max-width:30px;">
          '.$finaltitle.'
	'.do_shortcode($content).'
	   </div>'; 
	    $out .= $css_animation != '' ? '</div>' : '';	
    return $out;	
}

add_shortcode('featserv2', 'pix_featserv2');

/**************************************************/



/********************* DEAl PANEL **********************/

function pix_dealpan( $atts, $content = null ) {
 extract(shortcode_atts(array(
		"title" => '',
		"icon" => '',
		"offers" => '', 
		"href" => '' 
	), $atts));	
	
	$out = '';
	$finaltitle = ($title == '') ? '': ''.$title.'';
	$finallicon = ($icon == '') ? '': '<i class="fa '.esc_attr($icon).'"></i>';
	$finalloffers = ($offers == '') ? '': '    <span class="chart" data-percent="'.esc_attr($offers).'"> <span class="percent"></span> </span>  ';
	$finallhref = ($href == '') ? '#': $href;
	
	
	$out = '<div class="featured-item-simple-icon text-center" >
              <div class="ft-icons-simple"> '.$finallicon.' </div>
			  
			  '.$finalloffers.'
			  
           
              <h6>'.$finaltitle.'  </h6>
            </div> '; 

		
    return $out;	
}

add_shortcode('dealpan', 'pix_dealpan');

/**************************************************/

/********************* REVIEWS PANEL **********************/

function pix_review_group( $atts, $content ) {
	
	$GLOBALS['review_count'] = 0;
	
	do_shortcode( $content );
	if( is_array( $GLOBALS['reviews'] ) ){
		$count = 1;
		foreach( $GLOBALS['reviews'] as $review ){
			
			$finalimage = ($review['image'] == '') ? '': '<div class="avatar-review"><img src="'.esc_url($review['image']).'" alt="Avatar"></div>';
			$finalname = ($review['name'] == '') ? '': '<h3 class="heading">'.$review['name'].'</h3>';
			$finaljob = ($review['job'] == '') ? '': '<h4 class="sub-heading">'.$review['job'].'</h4>';
			
			$out = '<li> <div data-animation="fadeIn" class="team-member-item animated  fadeIn ">';
			$out .= 	$finalimage;
			$out .= '	<div class="details-review">';
			$out .= '		<div class="desc-det">'.do_shortcode($review['content']).'</div>';
			$out .= '		<div class="review-autor">'.$finalname.$finaljob.'</div>';
			$out .= '	</div>';
			$out .= '</div> </li>';			
			
			$reviews[] = $out;
			
			$count ++;
		}
                
		$return = ' <div data-animation="bounceInRight" class="animated reviews-frame">
        				<ul class="review-slider" >
							'.implode( "\n", $reviews ).'
						</ul>
					</div>
					 <div class="sly_scrollbar">
      <div class="handle"></div>
    </div>';	
	}
	return $return;
			
}

add_shortcode('reviewgroup', 'pix_review_group');



/*************** TESTIMONIALS ********************/
function pix_testimonial( $atts, $content = null ) {
    extract(shortcode_atts(array(
		"authorname"	=> '', 
		"authorposition"	=> ''
	), $atts));

	$out = '<div class="testimonial-block"><div class="testimonial-content"><p>'.do_shortcode($content).'</p></div><cite>'.$authorname.'</cite><p class="test_author">'.$authorposition.'</p></div>';
    return $out;
}
add_shortcode('testimonial', 'pix_testimonial');

/************************************************/





/***********  VC VIDEOS  ****************/

function pix_video($atts, $content=null) {
	extract(
		shortcode_atts(array(
			'site' => 'youtube',
			'id' => '',
			'width' => '',
			'height' => '',
			'autoplay' => '0'
		), $atts)
	);
	if ( $site == "youtube" ) { $src = 'http://www.youtube.com/embed/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id.'?autoplay='.$autoplay; }
	else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay='.$autoplay.'&permalinkId='.$id; }
	else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
	else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/embed/'.$id.'e/?f=1&offset=0&autoplay='.$autoplay; }
	
	if ( $id != '' ) {
		return '<div class="flex-video"><iframe width="'.esc_attr($width).'" height="'.esc_attr($height).'" src="'.esc_url($src).'" class="vid iframe-'.esc_attr($site).'"></iframe></div>';
	}
}
add_shortcode('video','pix_video');


add_shortcode( 'icontexttab', 'pix_icon_text_tab' );
add_shortcode('icontexttabs', 'pix_icon_text_tabs');

//** changed by VC dev team
function pix_icon_text_tabs( $atts, $content = null ) {
	$output='';
    $GLOBALS['icontexts'] = array();
	$GLOBALS['icontext_active_count'] = 1;
	$content_do = do_shortcode($content);	
	$GLOBALS['icontext_count'] = 0;
	if( is_array( $GLOBALS['icontexts'] ) && ! empty( $GLOBALS['icontexts'] ) ){
		foreach( $GLOBALS['icontexts'] as $icontext ){
		
			
			$active = $icontext['active'] ? 'class="tab-current"' : '';
			$tabs[] = '<li '.esc_attr($active).'><a href="#section-about-'.esc_attr($icontext['id']).'"><img  alt="tab image" src="'.esc_url($icontext['promo']).'"/></a></li>';
		}
        
		$output = '
		
		
		
			<div class="col-lg-6">	<div class="tab-content">' . $content_do . '</div></div>
			
			
			
			<div class="col-lg-6">
				  <div class="about-tabs-wrap">
				
					 <ul class="nav nav-tabs about-tabs">'.implode( "\n", $tabs ).'</ul>
				
				</div> </div>
					
					
			
				 
					 ';
		        
	}
	return $output;
	
   
}




// rewritted by vc dev team
function pix_icon_text_tab( $atts, $content ){
	
		$out = $image = '';
		
		
	extract(shortcode_atts(array(
	 	"title" => '',
		"image" => $image,
	 	"name" => '',
		"position" => '',
		"additional" => '',
		"promo" => ''
	), $atts));
	
	
	
	
	
	$img = wp_get_attachment_image_src( $image, 'large' );
	$img_output = $img[0];
	
	$_promo = wp_get_attachment_image_src( $promo, 'large' );
	$_promo_output = $_promo[0];
	
	
	
	
	$x = isset($GLOBALS['icontext_count'])?$GLOBALS['icontext_count']:0;
    $randomId = mt_rand(0, 100000);
    $count = isset($GLOBALS['icontext_active_count'])?$GLOBALS['icontext_active_count']:0;
	$GLOBALS['icontexts'][$x] = array( 'title' => $title,'promo' => $_promo_output,'image' => $img_output, 'id'=> $randomId, 'active'=>$count===1, 'content' => $content );
	$GLOBALS['icontext_count']++;
    
	$active = $count == 1 ? ' active' : '';
	
	
	
	
	$cont = '<section id="section-about-'.esc_attr($randomId).'"   class="tab-pane '.esc_attr($active).'">
	
	<blockquote class="blockquote-title"> '.$title.' </blockquote>
						
						<blockquote class="blockquote-quote"> <i class="fa fa-quote-left"></i>
               '.do_shortcode($content).'
              </blockquote>
			  
			  
			<div class="avatar-about"> <img  alt="'.$name.'" src="'.esc_url($img_output).'" >
                <h4>'.$name.'</h4>
                <p>'.$position.'</p>
                <p>'.$additional.'</p>
              </div>
							
					
						
			   </section>
    ';
    $GLOBALS['icontext_active_count']++;
	return $cont;
}




/*************** Carousel Content ****************/

function pix_caurusel_content( $atts, $content = null ) {
    $output = '';
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));
	
	do_shortcode($content);	 	
	$GLOBALS['caurusel_count'] = 0;
	
	
	
	
	if( is_array( $GLOBALS['caurusel_items'] ) ){
		$count = 1;
		foreach( $GLOBALS['caurusel_items'] as $item ){
			
			$socialIcons = '';
			if ($item['scn1'] || $item['scn2'] || $item['scn3'] || $item['scn4'] || $item['scn5']){
				$socialIcons = '<ul class="social-team">';
					if ($item['scn1']) $socialIcons.='<li><a href="'.esc_url($item['scn1']).'" target="_blank"><i class="fa '.esc_attr($item['scn_icon1']).'"></i></a></li>';
					if ($item['scn2']) $socialIcons.='<li><a href="'.esc_url($item['scn2']).'" target="_blank"><i class="fa '.esc_attr($item['scn_icon2']).'"></i></a></li>';
					if ($item['scn3']) $socialIcons.='<li><a href="'.esc_url($item['scn3']).'" target="_blank"><i class="fa '.esc_attr($item['scn_icon3']).'"></i></a></li>';
					if ($item['scn4']) $socialIcons.='<li><a href="'.esc_url($item['scn4']).'" target="_blank"><i class="fa '.esc_attr($item['scn_icon4']).'"></i></a></li>';
					if ($item['scn5']) $socialIcons.='<li><a href="'.esc_url($item['scn5']).'" target="_blank"><i class="fa '.esc_attr($item['scn_icon5']).'"></i></a></li>';
                    
                 $socialIcons .='</ul>';
			}
			
			$randomId = mt_rand(0, 100000);
			
			
			
			
			$out = '
			<li>
				<div class="x-item">		
				
				<a data-type="member-'.$randomId.'" href="#0"  class="bio-link">
				
				  <figure> <img width="270" height="337" src="'.esc_url($item['avatar']).'" alt="'.esc_attr($item['name']).'">
                  <div class="cd-img-overlay  ">
                    <div class="x-hover"> <span class="x-hover-text">'.esc_html__( 'View Bio', 'PixTheme' ).'</span> </div>
                  </div>
                </figure>
                <div class="cd-member-info">
                  <h4 class="staff-name">'.$item['name'].'</h4>
                </div>
   
                </a>
                <div class="staff-wrap">
                  <h5 class="staff-position">'.$item['postition'].'</h5>
                  '.$socialIcons.'
                  <div class="staff-shorty">
                   '.$item['short_desc'].'
                  </div>
                </div>
				
				
				
				
';
				
			
			
			
			
			$out.='                
			  		</div>
			</li>';
			
			$items[] = $out;
			
			$desc = '
			<div class="cd-member-bio member-'.$randomId.'">
				<div class="cd-member-bio-pict"> <img src="'.esc_url($item['avatar']).'" alt="'.esc_attr($item['name']).'" > </div>
				<div class="cd-bio-content">
          			<h3>'.$item['name'].'</h3>
					'.do_shortcode($item['content']).'
				</div>
			</div>';
			
			$full_desc[] = $desc;
			 
			$count ++;
		}
                
		$output = ' 
					<main id="cd-team" class="cd-team-class">
						<section class="xcarousel-2">					
					 		<div class="x-frame" >
								<ul class="x-slider" >
									'.implode( "\n", $items ).'
								</ul>
							</div> 
							<div class="x-navigation navigation"> 
								<a class="btn slider-direction prev-page" href="javascript:void(0);"><i class="icomoon-arrow-left2"></i></a> 
								<a class="btn  slider-direction next-page disabled" href="javascript:void(0);"><i class="icomoon-arrow-right2"></i></a> 
							</div>
						</section > 
						<div class="cd-overlay"></div> 
					</main>

					'.implode( "\n", $full_desc );
					
	}
	echo $output;
	
   
}
add_shortcode('caurusel_content', 'pix_caurusel_content');

///////////////////////////

function pix_caurusel_item( $atts, $content ){
	$image = '';
	extract(shortcode_atts(array(
	 	"avatar" => $image,
	 	"name" => '',
		"postition" => '',

		"scn1" => '',
		"scn_icon1" => '',
		"scn2" => '',
		"scn_icon2" => '',
		"scn3" => '',
		"scn_icon3" => '',
		"scn4" => '',
		"scn_icon4" => '',
		"scn5" => '',
		"scn_icon5" => '',
		"short_desc" =>'',
	), $atts));
	
	$img = wp_get_attachment_image_src( $avatar, 'large' );		
	$img_output = $img[0];
	
	$x = $GLOBALS['caurusel_count'];
	$GLOBALS['caurusel_items'][$x] = array( 'avatar' => $img_output, 'name' => $name, 'postition' => $postition, 'scn1' => $scn1, 'scn_icon1' => $scn_icon1, 'scn2' => $scn2, 'scn_icon2' => $scn_icon2, 'scn3' => $scn3, 'scn_icon3' => $scn_icon3, 'scn4' => $scn4, 'scn_icon4' => $scn_icon4, 'scn5' => $scn5, 'scn_icon5' => $scn_icon5, 'short_desc' => $short_desc, 'content' => $content );
	
	$GLOBALS['caurusel_count']++;
}
add_shortcode( 'caurusel_item', 'pix_caurusel_item' );
/************************************************/


/*************** Carousel Reviews ****************/

function pix_caurusel_reviews( $atts, $content = null ) {
    $output = '';
	extract(shortcode_atts(array(
		'title' => '',
		'is_carousel' => ''
	), $atts));
	
	do_shortcode($content);	 	
	$GLOBALS['review_count'] = 0;
	
	if( is_array( $GLOBALS['reviews'] ) ){
		$count = 1;
		foreach( $GLOBALS['reviews'] as $item ){
			$class = $count == 1 ? 'class="active"' : '';
			$out = '
			<li '.esc_attr($class).'>
			
              <div class="avatar-review "> <img  alt="'.$item['postition'].'" src="'.esc_attr($item['avatar']).'"> </div>
              <div class="details-review">
              '.do_shortcode($item['content']).'
                <div class="autor-date"> 
				<i class="fa fa-quote-left"></i>
                 <div class="autor-date">';
			if ($item['name']) $out.='<h6>'.$item['name'].'</h6>';
			if ($item['postition']) $out.='<p>'.$item['postition'].'</p>';
            $out.='	
                  </div>
                 
                </div>
              </div>
            </li>
';
			
			$reviews[] = $out;
			 
			$count ++;
		}
		
		
		
		//if 
		if (isset($is_carousel) && $is_carousel == "No"){
			$output = '<ul class="x-slider review-slider">
							'.implode( "\n", $reviews ).'
						</ul>';
		}else{
			$output = ' 
				<section class="xcarousel-3">
					<div class="x-frame">
						<ul class="x-slider review-slider">
							'.implode( "\n", $reviews ).'
						</ul>
					</div>
					<div class="x-navigation navigation"> 
						<a href="javascript:void(0);" class="btn slider-direction prev-page disabled"><i class="icomoon-arrow-left2"></i></a> 
						<a href="javascript:void(0);" class="btn  slider-direction next-page"><i class="icomoon-arrow-right2"></i></a> 
					</div>
				</section>';
		}
               
		
					
	}
	echo $output;
	
   
}
add_shortcode('caurusel_reviews', 'pix_caurusel_reviews');

///////////////////////////

function pix_caurusel_review( $atts, $content ){
	$image = '';
	extract(shortcode_atts(array(
	 	"avatar" => $image,
	 	"name" => '',
		"postition" => '',
	), $atts));
	
	$img = wp_get_attachment_image_src( $avatar , 'full' );		
	$img_output = $img[0];
	
	$x = $GLOBALS['review_count'];
	$GLOBALS['reviews'][$x] = array( 'avatar' => $img_output, 'name' => $name, 'postition' => $postition, 'content' => $content );
	
	$GLOBALS['review_count']++;
}
add_shortcode( 'caurusel_review', 'pix_caurusel_review' );
/************************************************/


/**************************VC FEATURED BLOCK****************/
function pix_fblock($atts, $content=NULL){
    extract(shortcode_atts(array(
		'icon'=>'', 
        'link'=>''
    ), $atts));
    
   
    $out='<div class="offers"><figure>';
    $out.='<a href="'.esc_url($link).'"><img src="'.esc_url($icon).'" alt="" /></a>';
    $out.='<div class="overlay">'.do_shortcode($content).'</div>';
    $out.='</figure></div>';
    return $out;
}
add_shortcode('fblock', 'pix_fblock');


/*********************************************************/

/*************** VC TITLE BLOCK***************************/
function pix_tblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
		'before'=>'',
		'css_animation' => '',
    ), $atts));
	
	//$css_class = getCSSAnimation($css_animation);
	
	$fullcontent = ($content == "") ? "" : '<div class="text-center after-title-info">'.do_shortcode($content).'  </div>';
	$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
    $out .='
	
	<div class="col-lg-12 text-center"><div class="heading-wrap '.esc_attr($css_animation).' ">
          <div class="small-logo">'.$before.'</div>
          <h2 class="section-heading">'.$title.'</h2>
        </div>     </div>
		
		

		'.$fullcontent; 
    $out .= $css_animation != '' ? '</div>' : '';
    return $out;
}

add_shortcode('tblock', 'pix_tblock');

/******************************************************/



/*************** VC TITLE BLOCK 2 ***************************/
function pix_tblock2($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
		'before'=>'',
		'css_animation' => '',
    ), $atts));
	
	//$css_class = getCSSAnimation($css_animation);
	
	$fullcontent = ($content == "") ? "" : '<div class="text-center after-title-info">'.do_shortcode($content).'  </div>';
	$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
    $out .='
	
	
	
	<div class="col-lg-12 text-center">
        <div class="heading-wrap  heading-wrap-style-2   '.esc_attr($css_animation).' " >
          <div class="small-logo">'.$before.'</div>
          <h2 class="section-heading">'.$title.'</h2>
     '.$fullcontent.'
        </div>
      </div>
	  
	 
	   <hr class="double-line">  
	
	'; 
    $out .= $css_animation != '' ? '</div>' : '';
    return $out;
}

add_shortcode('tblock2', 'pix_tblock2');

/******************************************************/






/*************** VC  SUBTITLE BLOCK***************************/
function pix_subtblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
		'css_animation' => '',
    ), $atts));
	
	//$css_class = getCSSAnimation($css_animation);
	
	$fullcontent = ($content == "") ? "" : '<div class="title-content"><div class="info-box">'.do_shortcode($content).' </div> </div>';
	$out = $css_animation != '' ? '<div class="animated" data-animation="' . esc_attr($css_animation) . '">' : '';
    $out .='
	
	<div class="section-subheading-center"><h4 class="section-subheading   hang '.esc_attr($css_animation).' ">'.$title.'</h4></div>

		'.$fullcontent; 
	
    $out .= $css_animation != '' ? '</div>' : '';
    return $out;
}

add_shortcode('subtblock', 'pix_subtblock');

/******************************************************/




/***********VC HEXAGON *************/

function pix_hexagon($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
		'link'=>'',
		'icon'=>'',
    ), $atts));
	
	$fullcontent = ($content == "") ? "" : '<div class="hb-footer-content">'.do_shortcode($content).'  </div>';
    $out='
	 
	
		<div class="hb-wrap hb-icon-box"> <a href="'.esc_url($link).'"><span class="hb hb-md"></span> <span class="hb2 hb hb-sm"> <span class="hb-content"> <span class="hb-icon"><i class="fa '.esc_attr($icon).'"></i></span> <span class="hb-title"> '.$title.' </span> </span> </span> </a></div>

		'.$fullcontent; 
    
    return $out;
}

add_shortcode('hexagon', 'pix_hexagon');

/******************************************************/





/***********VC STATE *************/

function pix_state($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
		'amount'=>'',
		'icon'=>'',
    ), $atts));
	
	$fullcontent = ($content == "") ? "" : '<div class="hb-footer-content">'.do_shortcode($content).'  </div>';
    $out='
	 
	
		<div  class="featured-item-simple-icon  text-center ">
              <div class="ft-icons-simple"><i class="fa '.esc_attr($icon).' "></i> </div>
              <span data-percent="'.esc_attr($amount).' " class="chart"> <span class="percent">'.$amount.' </span> <canvas height="0" width="0"></canvas></span>
              <h6>'.$title.' </h6>
            </div>

		'.$fullcontent; 
    
    return $out;
}

add_shortcode('state', 'pix_state');

/******************************************************



class WPBakeryShortCode_Oblock extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
		$out = $css_class = "";
        extract(shortcode_atts(array(
			'title'=>'',
			'before'=>'',
			'after'=>'',
			'css_animation' => '',				
		), $atts));
		
        $css_class .= $this->getCSSAnimation($css_animation);
		
		$out  = '<div class="' . $css_class . '">';
		$fullcontent = ($content == "") ? "" : '<div class="container"><div class="info-box">'.do_shortcode($content).' </div> </div>'; 
		$out .= '
			<div class="heading-wrap header-type2 ">
			  <div class="heading-wrap-line" style="margin-left: -130px;"></div>
			  <h4 class="sub-title  text-center">'.$before.'</h4>
			  <h2 class="section-heading">'.$title.'</h2>
			  <div class="sub-heading">
				<h4>'.$after.'</h4>
			  </div>			  
			</div>
			'.$fullcontent;
		$out .= '</div>';	
		return $out;
    }
}
//add_shortcode('oblock', 'pix_oblock');


/*************** VC TITLE BLOCK SIMPLE***************************
function pix_oblock($atts, $content=NULL){
    extract(shortcode_atts(array(
        'title'=>'',
		'before'=>'',
		'after'=>'',
		'css_animation' => '',				
    ), $atts));
	
	
	$fullcontent = ($content == "") ? "" : '<div class="container"><div class="info-box">'.do_shortcode($content).' </div> </div>'; 
	$out='
		<div class="heading-wrap header-type2 '.$css_animation.'">
		  <div class="heading-wrap-line" style="margin-left: -130px;"></div>
		  <h4 class="sub-title  text-center">'.$before.'</h4>
		  <h2 class="section-heading">'.$title.'</h2>
		  <div class="sub-heading">
			<h4>'.$after.'</h4>
		  </div>			  
		</div>
		'.$fullcontent;
	    
    return $out;
}

add_shortcode('oblock', 'pix_oblock');

/*******************************************************/





/***************BRAND BLOCK***************************/
function pix_brandblock($atts, $content=NULL){
	
		$out = $image = '';
		
		
    extract(shortcode_atts(array(
        'url'=>'',
		'image'=>'',
    ), $atts));
	
	
	
		$img = wp_get_attachment_image_src( $image, 'large' );
		
		
		$img_output = $img[0];

    if (!isset($GLOBALS['brands_count']))
    	$GLOBALS['brands_count'] = 0;
    $x = $GLOBALS['brands_count'];
	$GLOBALS['brands'][$x] = array( 'image' => esc_url($img_output), 'link' => esc_url($url) );
	
	$GLOBALS['brands_count']++;
    
    
    return $out;
}

add_shortcode('brandblock', 'pix_brandblock');






/******************************************************/




/******** SHORTCODE SUPPORT FOR WIDGETS *********/

if (function_exists ('shortcode_unautop')) {
	add_filter ('widget_text', 'shortcode_unautop');
}
add_filter ('widget_text', 'do_shortcode');

/************************************************/




?>