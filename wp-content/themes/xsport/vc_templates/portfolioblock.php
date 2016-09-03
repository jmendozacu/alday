<?php
global $post;
$out = $css_class = $cnt = '';

extract(shortcode_atts(array(
	'count'=>'',
	'cats'=>'',
	'css_animation' => '',				
), $atts));

$css_class .= $this->getCSSAnimation($css_animation);

if( $cats == '' ):
	$out .= '<p>'.__('No categories selected. To fix this, please login to your WP Admin area and set the categories you want to show by editing this shortcode and setting one or more categories in the multi checkbox field "Categories".', 'PixTheme');
else: 

$out = $css_animation != '' ? '<div class="" data-animation="' . esc_attr($css_animation) . '">' : '';
$out .= '	
        <div id="pix-portfolio"  class="portfolio-view "  >			 
			<div class="container">
				<div class="row">
				

        <div class="col-md-12">
          <div class="text-center filter ">
        
			
					<ul  id="filter"  class="portfolio-filter non-paginated">				
						<li class="title-action"><a href="#" class="current" data-filter="*">'. __('All Services' , 'PixTheme').'</a></li>';																		
							$MyWalker = new PortfolioWalker();
							$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '1', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '0', 'echo' => 0);
							$categories = wp_list_categories ($args);
$out .= '
						'.$categories.'
					</ul>
					
				</div>
				
			</div> 
			
			</div>
			
			</div>	
			
			
			
        
			<div class="isotope-frame">
				<div class="isotope-filter isotope" >';
				
	$portfolio_posts_to_query = get_objects_in_term( explode( ",", $cats ), 'portfolio_category');
	$args = array(
				'post_type' => 'portfolio', 
				'orderby' => 'menu_order',
				'post__in' => $portfolio_posts_to_query,			 
				'order' => 'ASC'
			);
	if( is_numeric($count) )
		$args['showposts'] = $count;
	else
		$args['numberposts'] = -1;
		
	$wp_query = new WP_Query( $args );
									
	if ($wp_query->have_posts()):
		while ($wp_query->have_posts()) : 							
						$wp_query->the_post();
						$cnt++;
						$custom = get_post_custom($post->ID);
						$pix_format = $custom['post_types_select'][0];						
						
						$cats = wp_get_object_terms($post->ID, 'portfolio_category');											   
												
						if ($cats){
							$cat_slugs = '';
							foreach( $cats as $cat ){
								$cat_slugs .= $cat->slug . " ";
							}
						}
						
						$link = ''; 
						$thumb_size = get_post_meta( get_the_ID(), 'thumb_size', true );
						$img_size = $thumb_size != '' ? 'portfolio-thumb-2x' : 'portfolio-thumb';
						$thumbnail = get_the_post_thumbnail($post->ID, $img_size, array('class' => 'cover'));
						
$out .= '
					
					<div class="isotope-item '.esc_attr($cat_slugs).' x-item '.esc_attr($thumb_size).'" >                        
						<div class="portfolio-image">
							'.$thumbnail.'
							<div class="slide-desc">
							
							<h3>'.$post->post_title.'</h3>
							
							<table><tr><td>';
switch ($pix_format){
	case "custom":  
		$out .= '
								<div class="detail-item">
									<p>'.pixtheme_limit_words(get_the_excerpt(), 10).'</p>
									'.get_post_meta( get_the_ID(), 'post_custom', true ).'
								</div>';   
		break;  

	case 'image':
		$gallery = rwmb_meta('post_image', 'type=image&size=portfolio-thumb');
		$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
		$link = $full_image[0];
		$out .= '
								<div class="detail-item">
									<p>'.pixtheme_limit_words(get_the_excerpt(), 10).'</p>
									<a  href="'.esc_url($link).'" class="btn btn-primary btn-lg  zoomPhoto"  rel="prettyPhoto[pp_gal_'.$post->ID.']"    >
									 <i class="icon-picture icon-large"></i> '. __('Learn More' , 'PixTheme').'
									</a><div style="position:absolute; left:-99999px;">';										
												foreach ($gallery as $key => $slide) {
													if($key>0)
		$out .= '									<a href="' . esc_url($slide['url']) . '" rel="prettyPhoto[pp_gal_'.$post->ID.']" ><img src="' . esc_url($slide['url']) . '" width="' . esc_attr($slide['width']) . '" height="' . esc_attr($slide['height']) . '" alt="' .esc_attr($slide['alt']).'" title="' .esc_attr($slide['title']). '"/></a>';
												}
		$out .= '									
									</div>
									
								</div>'; 
		break;  

	case 'link':
		$out .= '
								<div class="detail-item">
									<a  href="'.esc_url(get_permalink(get_the_ID())).'"   class="btn btn-primary btn-lg "  >
										 <i class="fa fa-file-word-o"></i>  '. __('Learn More' , 'PixTheme').'
									</a>								
								</div>'; 
		break;
		
	case 'video':
		$out .= '
								<div class="detail-item">
									<p>'.pixtheme_limit_words(get_the_excerpt(), 10).'</p>';
									if ( get_post_meta( get_the_ID(), 'post_video_href', true ) !== '' ): 
											$video_embed_code = get_post_meta( get_the_ID(), 'post_video_href', true );
											$video_width = get_post_meta( get_the_ID(), 'post_video_width', true );
											$video_height = get_post_meta( get_the_ID(), 'post_video_height', true );
										
		$out .= '							<a  href="'.esc_url($video_embed_code).'?width='.esc_attr($video_width).'&amp;height='. esc_attr($video_height).'" class="btn btn-primary btn-lg  video-popab"   >
										 <i class="fa fa-play-circle"></i>  '. __('Learn More' , 'PixTheme').'
										</a>';
									endif;
		$out .= '				</div>'; 
		break;
		
	default:
		$gallery = rwmb_meta('post_image', 'type=image&size=portfolio-thumb');
		$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
		$link = $full_image[0];
		$out .= '
								<div class="detail-item">
									<p>'.pixtheme_limit_words(get_the_excerpt(), 10).'</p>
									<a href="' . esc_url($slide['url']) . '" rel="prettyPhoto[pp_gal]" ><img src="' . esc_url($slide['url']) . '" width="' . esc_attr($slide['width']) . '" height="' . esc_attr($slide['height']) . '" alt="' .esc_attr($slide['alt']).'" title="' .esc_attr($slide['title']). '"/></a>
									<div style="position:absolute; left:-99999px;">';										
												foreach ($gallery as $key => $slide) {
													if($key>0)
		$out .= '									';
												}
		$out .= '									
									</div>
									<a  href="'.esc_url($link).'" class="btn btn-primary btn-lg  zoomPhoto" rel="prettyPhoto[pp_gal]"  >
										 <i class="icon-picture icon-large"></i>  '. __('Learn More' , 'PixTheme').'
									</a>
								</div>';  
		break;
}						
$out .= '	
							</td></tr></table></div>
						</div>
					</div>';	
	
		 endwhile;
	endif;
	 
$out .= '            
            	</div>	<!--end-->
			</div> <!--end isotop frame-->';

	if ($wp_query->have_posts()): 
		while ($wp_query->have_posts()) : 							
			$wp_query->the_post(); 
	$out .= '<div class="portfolio-modal modal fade" id="myModal'.esc_attr($post->ID).'"  >
				<div class="modal-content"> </div>
			</div>';
		endwhile;
	endif;
		
$out .= '
		</div>
 
	';
$out .= $css_animation != '' ? '</div>' : '';
endif;	
echo $out;