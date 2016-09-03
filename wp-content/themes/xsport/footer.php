<?php 
global $post;


if (isset($GLOBALS['pix_footer_type_page']) && $GLOBALS['pix_footer_type_page'] && $GLOBALS['pix_footer_type_page'] != 'global'){
	$footerBlockId = $GLOBALS['pix_footer_type_page'];
}else{
	$footerBlockId = pixtheme_get_option('pix_footer_staticblock');
	
}






if ($footerBlockId){
	$post = $fpost = get_post( $footerBlockId );
	$fslug = esc_attr($fpost->post_name);
	
	
	$pix_decor = get_post_meta($footerBlockId, 'pix_page_landing_decor', true);
		
	$pix_preset = get_post_meta($footerBlockId, 'homepage_preset', true);
	$pix_preset_text = get_post_meta($footerBlockId, 'homepage_preset_text', true);
	$pix_slider = rwmb_meta('sequence_upload', 'type=image&size=full',$footerBlockId);
	
	
	

	$pixtheme_slider = get_post_meta($footerBlockId, 'homepage_slider', true);
	$out_slider = "";
	
	foreach($pix_slider as $slide) {
		$out_slider .= '<li><div style="background-image:url(' . esc_url($slide['url']) . ')" class="bg-slide"></div></li>';			
	}	
	$custom_color = get_post_meta($footerBlockId, 'cs_homepage_bgcolor', true);
	$bg_image = get_post_meta($footerBlockId, 'homepage_bgimage', true);
	$src = wp_get_attachment_image_src($bg_image, 'full');
	
	$style = ($bg_image) ?'background-image:url('.esc_url($src[0]).');':''; 
	$bg_color = ($custom_color) ? 'background-color:'.esc_attr($custom_color) : '';
	$class_preset = ($pix_preset) ? 'no-bg-color-parallax parallax-'.$pix_preset.' ' : '';
	$class_preset_text = ($pix_preset_text) ? ' '.$pix_preset_text : '';
	
	$_no_padding = get_post_meta($footerBlockId, 'pix_page_section_nopadding', true);
	
	$class_preset_padding = ($_no_padding) ? ' no-padding' : '';
	$class = $class_preset.'home-section'.$class_preset_text.$class_preset_padding;
	$page_template_name = get_post_meta($footerBlockId,'_wp_page_template',true);
	
	$pix_decor_top = $out_slider != "" ? '' : '		<div class="section-footer ">
														<div class="sf-left" style="'.esc_attr($bg_color).'"></div>
														<div class="sf-right" style="'.esc_attr($bg_color).'"></div>
													
													</div>';
	
	$pix_decor_bottom = $out_slider != "" ? '' : '	<div class="section-footer sf-type-2">
													
														<div class="sf-left" style="'.esc_attr($bg_color).'"></div>
														<div class="sf-right" style="'.esc_attr($bg_color).'"></div>
												
													</div>';
													
											
	
}


?>
<?php if ($footerBlockId):?>
<footer class="footer footer-shop <?php echo esc_attr($fslug) ?> <?php echo esc_attr($class); ?>" style="<?php echo esc_attr($bg_color); ?>">
       <?php
			

			$shortcodes_custom_css = get_post_meta( $fpost->ID, '_wpb_shortcodes_custom_css', true );
			  if ( ! empty( $shortcodes_custom_css ) ) {
			   echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			   echo esc_html($shortcodes_custom_css);
			   echo '</style>';
			}

			echo apply_filters('the_content', $fpost->post_content);
		?>
</footer>
<?php else: ?>




<?php endif; ?>






<?php $pix_options = isset($_POST['options']) ? $_POST['options'] : get_option('pix_general_settings');?>
<?php if (isset($pix_options['pix_custom_js'])) echo esc_js($pix_options['pix_custom_js']); ?>
</div>
<!--#page-content-wrapper-->
</div></div> 
<!--#content-->
<!-- end layout-theme -->
</div> 


<div class="la-anim-1"></div>


<?php
    wp_footer();
?>





</body></html>