<?php
$out =  '';
 extract(shortcode_atts(array(
		"title" => '',		
		"link" => '',
		"title2" => '',		
		"link2" => '',
	), $atts));	
		
	$out = '	
  <div class="banner-full-width" id="banner01">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-md-7 text-right">
          '.do_shortcode($content).'
        </div>
        <div class="col-lg-5 col-md-5 text-right">
          <div class="btn-fw-banner"><a href="'.esc_url($link).'" class="btn btn-lg">'.wp_kses_post($title).'</a> <a href="'.esc_url($link2).'" class="btn btn-primary btn-lg ">'.wp_kses_post($title2).'</a></div>
        </div>
      </div>
    </div>
  </div>
	';

echo $out;