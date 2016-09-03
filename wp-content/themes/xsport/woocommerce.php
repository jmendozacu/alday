<?php 
$is_product_page = false;
if( is_shop() || is_product_category() || is_product_tag() ) 
    $id = get_option( 'woocommerce_shop_page_id' );
elseif( is_product() || !empty($post->ID) ){
	$id = $post->ID;
	$is_product_page = true;	
}
else
	$id = 0;

$custom = $id > 0 ? get_post_custom($id) : '';
$pix_options = get_option('pix_general_settings');



if ($is_product_page == true){
	$layout = isset ($custom['pix_page_layout']) ? $custom['pix_page_layout'][0] : '2';
	$sidebar = isset ($custom['pix_selected_sidebar'][0]) ? $custom['pix_selected_sidebar'][0] : 'Shop Sidebar';
	
}else{
	$layout = isset ($custom['pix_page_layout']) ? $custom['pix_page_layout'][0] : '2';
	$sidebar = isset ($custom['pix_selected_sidebar'][0]) ? $custom['pix_selected_sidebar'][0] : 'Shop Sidebar';
	
}





?>


<?php get_header();?>

<main id="main" class="section">

<div class="container">
    <div class="row">
		
		<?php if ($layout == '3'):?>
          <div class="col-xs-12 col-sm-12 col-md-3">
        <aside class="sidebar">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?> <?php   endif;?>
        </aside>
        </div>
        <?php endif?>
		
        <div class="col-xs-12 <?php if ($layout == '1'):?>  col-sm-12 col-md-12 <?php else: ?> col-sm-12 col-md-9 <?php endif?>">
       
 		<?php  woocommerce_content(); ?>
 
 		</div>
        
        <?php if ($layout == '2'):?>
           <div class="col-xs-12 col-sm-12 col-md-3">
            <aside class="sidebar">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?> <?php   endif;?>
            </aside>
        </div>
        <?php endif?>
        
    </div>
</div>
 
</main>


           
<?php get_footer();?>
