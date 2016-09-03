<?php

/** PixTheme Options Page **/

$theme_name = 'PixTheme';
$shortname = 'pix';
$theme_version = '1.0';
$path = get_stylesheet_directory_uri();
$styles = array();
$background_options = array();
$skins = array();

if (is_dir(TEMPLATEPATH . "/css/")) {
	if ($open_dir = opendir(TEMPLATEPATH . "/css/")) {
		while (($style = readdir($open_dir)) !== false) {
			if (stristr($style, ".css") !== false) {
				$styles[] = $style;
			}
		}
	}
}


$html_desc = 'Enter HTML text';
$html_desc_p = 'Enter HTML text NOTE: Text must be between "p" tags';
$text_desc = 'Enter text';
$long_text = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et dignissim ipsum. Nam ac interdum sem. Pellentesque diam lacus, dictum in dapibus id, hendrerit eget felis. Nunc nec turpis libero</p>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas euismod condimentum mollis. In non congue orci. Nulla nunc velit, volutpat vestibulum congue vitae, tincidunt at sem. Pellentesque tincidunt molestie mi, eu aliquam quam fringilla nec. Sed suscipit adipiscing urna, et varius libero commodo eget.</p>';

$upload_desc = 'Upload image for your theme, or specify an existing url';

// Array added for 3D Rotator
$tween_types = array(
	array("value"=>"linear", "text"=>"linear"),
	array("value"=>"easeInSine", "text"=>"easeInSine"),
	array("value"=>"easeInSine", "text"=>"easeInSine"),
	array("value"=>"easeInOutSine", "text"=>"easeInOutSine"),
	array("value"=>"easeInCubic", "text"=>"easeInCubic"), 
	array("value"=>"easeOutCubic", "text"=>"easeOutCubic"),
	array("value"=>"easeInOutCubic", "text"=>"easeInOutCubic"), 
	array("value"=>"easeOutInCubic", "text"=>"easeOutInCubic"), 
	array("value"=>"easeInQuint", "text"=>"easeInQuint"), 
	array("value"=>"easeOutQuint", "text"=>"easeOutQuint"),
	array("value"=>"easeInOutQuint", "text"=>"easeInOutQuint"),
	array("value"=>"easeOutInQuint", "text"=>"easeOutInQuint"),
	array("value"=>"easeInCirc", "text"=>"easeInCirc"),
	array("value"=>"easeOutCirc", "text"=>"easeOutCirc"), 
	array("value"=>"easeInOutCirc", "text"=>"easeInOutCirc"),
	array("value"=>"easeOutInCirc", "text"=>"easeOutInCirc"),
	array("value"=>"easeInBack", "text"=>"easeInBack"), 
	array("value"=>"easeOutBack", "text"=>"easeOutBack"), 
	array("value"=>"easeInOutBack", "text"=>"easeInOutBack"), 
	array("value"=>"easeOutInBack", "text"=>"easeOutInBack"),
	array("value"=>"easeInQuad", "text"=>"easeInQuad"),
	array("value"=>"easeOutQuad", "text"=>"easeOutQuad"),
	array("value"=>"easeInOutQuad", "text"=>"easeInOutQuad"),
	array("value"=>"easeOutInQuad", "text"=>"easeOutInQuad"), 
	array("value"=>"easeInQuart", "text"=>"easeInQuart"), 
	array("value"=>"easeOutQuart", "text"=>"easeOutQuart"),
	array("value"=>"easeInOutQuart", "text"=>"easeInOutQuart"), 
	array("value"=>"easeOutInQuart", "text"=>"easeOutInQuart"),
	array("value"=>"easeInExpo", "text"=>"easeInExpo"), 
	array("value"=>"easeOutExpo", "text"=>"easeOutExpo"), 
	array("value"=>"easeInOutExpo", "text"=>"easeInOutExpo"),
	array("value"=>"easeOutInExpo", "text"=>"easeOutInExpo"),
	array("value"=>"easeInElastic", "text"=>"easeInElastic"), 
	array("value"=>"easeOutElastic", "text"=>"easeOutElastic"), 
	array("value"=>"easeInOutElastic", "text"=>"easeInOutElastic"), 
	array("value"=>"easeOutInElastic", "text"=>"easeOutInElastic"), 
	array("value"=>"easeInBounce", "text"=>"easeInBounce"), 
	array("value"=>"easeOutBounce", "text"=>"easeOutBounce"),
	array("value"=>"easeInOutBounce", "text"=>"easeInOutBounce"),
	array("value"=>"easeOutInBounce", "text"=>"easeOutInBounce")
);



?>