<?php


function pixContentImporter(){
	if (isset($_GET['pix-import'])){
		if (is_admin()){

		
			$_importerPluginFile = ABSPATH . 'wp-content/plugins/wordpress-importer/wordpress-importer.php';
			$dummyFile = get_template_directory() . '/library/import/xsport.xml';
			
			
			
			
			if (file_exists($_importerPluginFile) && file_exists($dummyFile)){
				do_action( 'load-importer-wordpress');
				
				
				
				
				$wpImporter = new WP_Import();

				$wpImporter->import($dummyFile);
				echo "Imported";
			}
			
		}else{
			exit();
		}
	}

}






?>