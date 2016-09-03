<?php

add_action( 'add_meta_boxes', 'posts_init' );
function posts_init(){
	add_meta_box("sidebar_options", __("PixTheme - Page Layout Options", 'PixAdmin'), "pix_sidebar_options", "post", "side", "low");
	add_meta_box("sidebar_options", __("PixTheme - Page Layout Options", 'PixAdmin'), "pix_sidebar_options", "page", "side", "low");	
	add_meta_box("sidebar_options", __("PixTheme - Page Layout Options", 'PixAdmin'), "pix_sidebar_options", "product", "side", "low");
}

/** START SIDEBAR OPTIONS */

function pix_sidebar_options(){	
	global $post;
	$post_id = $post;
	if (is_object($post_id)) {
		$post_id = $post_id->ID;
	}
	
	
	
	$selected_type_sidebar = (get_post_meta($post_id, 'pix_page_layout', true) == "") ? 2 : get_post_meta($post_id, 'pix_page_layout', true);
	$selected_header_type = (get_post_meta($post_id, 'pix_page_header_type', true) == "") ? 'global' : get_post_meta($post_id, 'pix_page_header_type', true);
	$selected_footer_block = (get_post_meta($post_id, 'pix_page_footer_staticblock', true) == "") ? 'global' : get_post_meta($post_id, 'pix_page_footer_staticblock', true);
	
	$args = array(
		'post_type'        => 'staticblocks',
		'post_status'      => 'publish',
	);
	$staticBlocks = array();
	$staticBlocks['global'] = __('Use global settings','PixTheme');
	$staticBlocksData = get_posts( $args );
	foreach($staticBlocksData as $_block){
		$staticBlocks[$_block->ID] =  $_block->post_title;
	}
	
	$selected_sidebar = get_post_meta($post_id, 'pix_selected_sidebar', true);
	if(!is_array($selected_sidebar)){
		$tmp = $selected_sidebar; 
		$selected_sidebar = array(); 
		$selected_sidebar[0] = $tmp;
	}
	
	?>
	
	<p><strong><?php echo __('Sidebar type', 'PixAdmin')?></strong></p>
	
	<select class="rwmb-select" name="pix_page_layout" id="pix_page_layout" size="0">
		<option value="1" <?php if ($selected_type_sidebar == 1):?>selected="selected"<?php endif?>><?php echo __('Full width', 'PixAdmin')?></option>
		<option value="2" <?php if ($selected_type_sidebar == 2):?>selected="selected"<?php endif?>><?php echo __('Right Sidebar', 'PixAdmin')?></option>
		<option value="3" <?php if ($selected_type_sidebar == 3):?>selected="selected"<?php endif?>><?php echo __('Left Sidebar', 'PixAdmin')?></option>
	</select>
	<?php ?>
	
	<p><strong><?php echo __('Sidebar content', 'PixAdmin')?></strong></p>
	<ul>
	<?php 
	global $wp_registered_sidebars;
	
		for($i=0;$i<1;$i++){ ?>
			<li>
			<select name="sidebar_generator[<?php echo esc_attr($i)?>]">
				<!--<option value=""<?php if($selected_sidebar[$i] == ''){ echo " selected";} ?>><?php echo __('WP Default Sidebar', 'PixAdmin')?></option>-->
			<?php
			$sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
			if(is_array($sidebars) && !empty($sidebars)){
				foreach($sidebars as $sidebar){
					if($selected_sidebar[$i] == $sidebar['id']){
						echo "<option value='".esc_attr($sidebar['id'])."' selected>{$sidebar['name']}</option>\n";
					}else{
						echo "<option value='".esc_attr($sidebar['id'])."'>{$sidebar['name']}</option>\n";
					}
				}
			}
			?>
			</select>
			</li>
		<?php } ?>
	</ul>
	
	<p><strong><?php echo __('Header type', 'PixAdmin')?></strong></p>
	
	<select class="rwmb-select" name="pix_page_header_type" id="pix_page_header_type" size="0">
		<option value="global" <?php if ($selected_header_type == 'global'):?>selected="selected"<?php endif?>><?php echo __('Use global settings', 'PixAdmin')?></option>
		<option value="pix-header1" <?php if ($selected_header_type == 'pix-header1'):?>selected="selected"<?php endif?>><?php echo __('Header #1', 'PixAdmin')?></option>
		<option value="pix-header2" <?php if ($selected_header_type == 'pix-header2'):?>selected="selected"<?php endif?>><?php echo __('Header #2', 'PixAdmin')?></option>
	</select>

	<p><strong><?php echo __('Footer Static Block', 'PixAdmin')?></strong></p>
	<ul>

			<li>
			<select name="pix_page_footer_staticblock">				
			<?php foreach($staticBlocks as $id => $_staticBlock){ 
					if($id == $selected_footer_block){
						echo "<option value='".esc_attr($id)."' selected>".esc_attr($_staticBlock)."</option>\n";
					}else{
						echo "<option value='".esc_attr($id)."'>".esc_attr($_staticBlock)."</option>\n";
					}
				}
			?>
			</select>
			</li>
	</ul>		
<?php }

/** END SIDEBAR OPTIONS */


function save_postdata( $post_id ) {
	
	if ( wp_is_post_revision( $post_id ) )
		return;
		
		
	global $post, $new_meta_boxes;

	
	if(isset($new_meta_boxes))
	foreach($new_meta_boxes as $meta_box) {
		
		if ( $meta_box['type'] != 'title)' ) {
		
			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}
			
			if (isset($_POST[$meta_box['name']]) && is_array($_POST[$meta_box['name']]) ) {
				$cats = '';
				foreach($_POST[$meta_box['name']] as $cat){
					$cats .= $cat . ",";
				}
				$data = substr($cats, 0, -1);
			}
			
			else { $data = ''; if(isset($_POST[$meta_box['name']])) $data = $_POST[$meta_box['name']]; }			
			
			if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
				
		}
	}
	
	pix_save_sidebar_data( $post_id );
	
}

function pix_save_sidebar_data( $post_id ){

	global $post;
	
	if (isset($_POST['pix_page_layout'])){
		if(get_post_meta($post_id, 'pix_page_layout') == "")
			add_post_meta($post_id, 'pix_page_layout', $_POST['pix_page_layout'], true);
		else
			update_post_meta($post_id, 'pix_page_layout', $_POST['pix_page_layout']);
	}
	
	if (isset($_POST['sidebar_generator'][0])){
		if(get_post_meta($post_id, 'pix_page_layout') == "")
			add_post_meta($post_id, 'pix_selected_sidebar', $_POST['sidebar_generator'][0], true);
		else
			update_post_meta($post_id, 'pix_selected_sidebar', $_POST['sidebar_generator'][0]);
	}
	
	if (isset($_POST['pix_page_header_type'])){
		if(get_post_meta($post_id, 'pix_page_header_type') == "")
			add_post_meta($post_id, 'pix_page_header_type', $_POST['pix_page_header_type'], true);
		else
			update_post_meta($post_id, 'pix_page_header_type', $_POST['pix_page_header_type']);
	}
	

	if (isset($_POST['pix_page_footer_staticblock'])){
		if(get_post_meta($post_id, 'pix_page_footer_staticblock') == "")
			add_post_meta($post_id, 'pix_page_footer_staticblock', $_POST['pix_page_footer_staticblock'], true);
		else
			update_post_meta($post_id, 'pix_page_footer_staticblock', $_POST['pix_page_footer_staticblock']);
	}

}

add_action('save_post', 'save_postdata');

?>