<?php
$out = $css_class = '';

extract(shortcode_atts(array(
	'title'=>'',
	'before'=>'',
	'after'=>'',
	'css_animation' => '',				
), $atts));

$css_class .= $this->getCSSAnimation($css_animation);

$out  = '<div class="' . esc_attr($css_class) . '">';
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
echo $out;