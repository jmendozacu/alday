<?php

/*** ADMIN MENU ****/

add_theme_page($theme_name, 'Xsport Options', 'administrator', 'adminpanel', 'adminpanel',  get_template_directory_uri(). '/library/admin/images/logo.png');
	
add_theme_page('adminpanel', $theme_name, 'General Settings', 'administrator', 'adminpanel', 'adminpanel');









?>
