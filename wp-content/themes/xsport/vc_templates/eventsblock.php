<?php
global $post;
$out = $css_class = $cnt = '';

extract(shortcode_atts(array(
	'count'=>'',
	'css_animation' => '',				
), $atts));



$css_class .= $this->getCSSAnimation($css_animation);
wp_enqueue_script('pixtheme-countdown', get_template_directory_uri() . '/assets/countdown/jquery.countdown.min.js');
$out = $css_animation != '' ? '<div class="" data-animation="' . esc_attr($css_animation) . '">' : '';

$out .= '
	
        <div class="cd-events-wrapper cd-container animated" data-animation="bounceInUp">  
          <!-- cd-events -->
			<ul class="cd-events" >';
$args = array(
			'post_type' => 'tribe_events', 
			'orderby' => 'menu_order',			 
			'order' => 'ASC', 
			'showposts' => $count,
			//'meta_key' => 'event-end-date',
			//'meta_value' => current_time('timestamp',0),
			//'meta_compare' => '>'
		);
$wp_query = new WP_Query( $args );
			 						
					
	if ($wp_query->have_posts()):  
		$cnt = 0;
		while ($wp_query->have_posts()) : 							
						$wp_query->the_post();
						$cnt++;
						$custom = get_post_custom($post->ID);
						
						$eventUrl = get_site_url() . '?post_type=tribe_events&p=' . $post->ID;
						
						
						$link = !empty($eventUrl) ? '<a href="'.esc_url($eventUrl).'" class="cd-see-all btn btn-danger"><i class="icon-exclamation-sign"></i>'.__('See event', 'PixShortcode').'</a>' : '';
						// Get the portfolio item categories
						$cats = wp_get_object_terms($post->ID, 'event_category');
						if(strtotime($post->EventStartDate) >= current_time('timestamp',0))
							$event_time = strtotime($post->EventStartDate);
						else
							$event_time = strtotime($post->EventEndDate);							
						
		
						
$out .= '
            <li>
			
			
			<table>
  <tbody>
    <tr>
      <td>    <div class="events-image">'.get_the_post_thumbnail($post->ID, 'event-thumb').'</div></td>
      <td>   
                <div class="events-content">
                  <h3>'.get_the_title($post->ID).'</h3>
                  <div class="events-date">'.date( 'F d, Y', strtotime($post->EventStartDate) ).' - '.date( 'F d, Y', strtotime($post->EventEndDate) ).'</div>
                  <p>'.get_the_excerpt().'</p>
             
              </div></td>
      <td>';
      
      
      if((strtotime($post->EventEndDate)-3600 * 24) > current_time('timestamp',0)){
	      
      
       $out .= '<div class="x-coutdown">
                  <h5>'.__('THE COUNTDOWN BEGINS', 'PixShortcode').'</h5>
                  <div class="x-coutdown-inner">
                    <div id="x-coutdown-timer'.esc_attr($cnt).'">
					';

$out .= '	




				
<script>
    


/////////////////////////////////////
//  Clock
///////////////////////////////////// 

jQuery(function($) {
  
	$("#x-coutdown-timer'.esc_js($cnt).'").countdown("'.esc_js(date( 'Y/m/d', $event_time )).'").on("update.countdown", function(event) {
		var $this = $(this).html(event.strftime(""
		 + \'<div class="x-cdr"><span>%D</span> <strong>day%!d</strong> </div>\'
		 + \'<div class="x-cdr"><span>%H</span> <strong>hr</strong> </div>\'
		 + \'<div class="x-cdr"><span>%M</span> <strong>min</strong> </div>\'
		 + \'<div class="x-cdr last"><span>%S</span> <strong>sec</strong> </div>\'));
	});
	
});



</script>';
 
$out .= '                    
                  </div>
                  '.$link.' </div>
              </div>';
              
              }
             $out .= '</td>
    </tr>
  </tbody>
</table>



             
            
       
           

               
            </li>
 
	';	
	
		 endwhile;
		 endif;
	 
$out .= '            
            </ul>		  
          <!-- cd-events-all-wrapper -->		  
        </div>
 
	';
$out .= $css_animation != '' ? '</div>' : '';	
echo $out;