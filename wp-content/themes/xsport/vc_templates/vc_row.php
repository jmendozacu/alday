<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $full_width = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $pdecor = $ptextcolor = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $full_width = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	//vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	//$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$css_classes[] = ' vc_row-o-content-' . $content_placement;
	}
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[] = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty ( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';







/** Templines */


$qo = get_queried_object();



if ($qo && isset($qo->ID)){
	
	@$tpl_page =  get_page_template_slug($qo->ID);
}else{
	@$tpl_page =  get_page_template();
}




if ( get_post_type( get_the_ID() ) == 'staticblocks'){
	$_block = get_post(get_the_ID());
	
	if ($_block && strpos($_block->post_name,'ooter')){
		$full_width = array();
		$tpl_page = 'template-home.php';
	}
}




if ($pdecor == "Top")
	$pix_decor_class = " top-decor";
elseif ($pdecor == "Bottom")
	$pix_decor_class = " bottom-decor";	
elseif ($pdecor == "Both")
	$pix_decor_class = " both-decor";
else
	$pix_decor_class = "";
	
$pix_slider = rwmb_meta('sequence_upload', 'type=image&size=full');


$pix_slides = explode(",",$pbgslides);
$out_slider = "";
foreach($pix_slides as $slide) {
	$att_arr = wp_get_attachment_image_src($slide,'full');
	if (isset($att_arr[0])){
		$att = $att_arr[0];
		$out_slider .= '<li><div style="background-image:url(' . esc_url($att) . ')" class="bg-slide"></div></li>';					
	}

}	


$pix_decor_top =  $out_slider != "" ? '' :'		<div class="section-footer ">
													<div class="sf-left" style="'.esc_attr($bg_color).'"></div>
													<div class="sf-right" style="'.esc_attr($bg_color).'"></div>
												
												</div>';

$pix_decor_bottom = $out_slider != "" ? '' :'	<div class="section-footer sf-type-2">
												
													<div class="sf-left" style="'.esc_attr($bg_color).'"></div>
													<div class="sf-right" style="'.esc_attr($bg_color).'"></div>
											
												</div>';	


$class_preset_text = ($ptextcolor) ? ' text-'.strtolower($ptextcolor) : '';
if ($ptextcolor == "Default")
	$class_preset_text = "";


// wp_enqueue_style( 'js_composer_front' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) .  $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

//$style = $this->buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );


?>
<div <?php
	?>class="<?php echo esc_attr( $css_class . $pix_decor_class . $class_preset_text ); ?><?php if ( $full_width == 'stretch_row_content_no_spaces' ): echo ' vc_row-no-padding'; endif; ?>" <?php if ( ! empty( $full_width ) ) {
	echo ' data-vc-full-width="true"';
	if ( $full_width == 'stretch_row_content' || $full_width == 'stretch_row_content_no_spaces' ) {
		echo ' data-vc-stretch-content="true"';
	}
} ?> <?php // echo $style; ?>>
<ul class="bg-slideshow">
    <?php echo $out_slider; ?>
  </ul>
<?php if(in_array($pdecor, array("Top","Both"))) echo wp_kses_post($pix_decor_top);?>
<?php if (empty( $full_width ) && $tpl_page == 'template-home.php' ):?>
<div class="container">
<?php endif;?>
<?php
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';

echo $output;
?>
<?php if (empty( $full_width ) && $tpl_page == 'template-home.php' ):?>
</div>
<?php endif;?>
<?php if(in_array($pdecor, array("Bottom","Both"))) echo wp_kses_post($pix_decor_bottom);?>
</div><?php echo $this->endBlockComment( 'row' );
if ( ! empty( $full_width ) ) {
	echo '<div class="vc_row-full-width"></div>';
}
echo $after_output;
?>