<?php
/*** INCLUDE FILES ***/

require_once($adminPath . 'theme-settings.php');
require_once($adminPath . 'content-importer.php');



/*** ADMIN SCRIPTS ***/

function pix_admin_scripts() {

	// Admin Stylesheet
	wp_enqueue_style('PixTheme-admin-styles',get_template_directory_uri(). '/library/admin/css/admin.css', false, '1.0.0', 'screen');
	wp_enqueue_style('PixTheme-colorpicker', get_template_directory_uri(). '/library/admin/css/colorpicker.css', false, '1.0.0', 'screen');
	wp_enqueue_style('PixTheme-uistyles', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery.ui.all.css', false, '1.0.0', 'screen');
	wp_enqueue_script('PixTheme-jquery-cookie', get_template_directory_uri() . '/library/admin/js/jquery.cookie.js', array('jquery'), '1.0.0');


	// JAVASCRIPT
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('jqueryui');	
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script( 'jquery-ui-sortable' );
	
	wp_enqueue_script('PixTheme-admin', get_template_directory_uri() . '/library/admin/js/admin.js', array('jquery'), '1.0.0');
	wp_enqueue_script('Vertical Tabs',  get_template_directory_uri(). '/library/admin/js/jquery-jvert-tabs-1.1.4.js', array('jquery'), '1.1.4');
	wp_enqueue_script('PixTheme-filestyle', get_template_directory_uri() . '/library/admin/js/filestyle.js', array('jquery'), '1.0.0');
	
}

add_action('admin_enqueue_scripts', 'pix_admin_scripts');

/*** Admin Header ****/


function pix_admin_head() { ?>
	<script type="text/javascript">
    	jQuery.noConflict();
    	
		jQuery(document).ready(function () {
			jQuery(".toggle_container").hide(); 
    		jQuery("h2.toggle-trigger").click(function(){
    			jQuery(this).toggleClass("active").next().slideToggle("slow");
				return false;
			});
		
			jQuery("#vtabs1").jVertTabs();
    		
    		jQuery('form#post').attr('encoding','multipart/form-data');
        	// File input style
        	jQuery('div.r-upload input[type=file]').filestyle({ 
            	imageheight : 20,
            	imagewidth : 80,
            	width : 120
        	});
			
			
			
		// Upload errors
	 	<?php
		$upload_tracking = get_option('r_tracking');
		if (!empty($upload_tracking)) {
			foreach($upload_tracking as $array) {
				if (array_key_exists('error', $array)) { ?>
					jQuery('form#post').before('<div class="updated fade"><p>Theme Upload Error: <strong><?php echo wp_kses_post($array['upload_name']) ?></strong> - <?php echo wp_kses_post($array["error"]) ?></p></div>');
			  	<?php
				}
			}
		}
		delete_option('r_tracking'); 
		?>
    	}) // End scripts
    </script>
<?php
}
add_action('admin_head', 'pix_admin_head');
?>