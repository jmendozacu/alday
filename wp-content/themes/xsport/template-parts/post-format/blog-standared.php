
<?php
/**
 * This template is for displaying part of blog.
 *
 * @package Pix-Theme
 * @since 1.0
 */
$pixtheme_format  = get_post_format();
$pix_options = get_option('pix_general_settings');
$custom =  get_post_custom($post->ID);


$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$pixtheme_format  = get_post_format();
$pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? "standared" : $pixtheme_format;
$icon = array("standared" => "icon-picture", "quote" => "fa fa-pencil", "gallery" => "icon-camera", "video" => "fa fa-video-camera");
$post_date = strtotime($post->post_date);
?>

<div class="entry-media">


<div class="box-date-post"> <?php echo sprintf('<span class="date-1">%d</span> <span class="date-2">%s</span>',esc_attr(date('d',$post_date)),esc_attr(date('F',$post_date)))?> </div>



<div class="entry-thumbnail">



<div class="img-overlay "> <a href="<?php esc_url(the_permalink())?>"  class="link-view-more"></a> </div>



 <div class="post-type-media type-image"><i class="<?php echo esc_attr($icon[$pixtheme_format]); ?>"></i> </div>


    
		<?php if ( has_post_thumbnail() ):?>  
        
        
       <?php the_post_thumbnail(); ?> 
            
            
		<?php else : ?>
        	<img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/noimage.jpg"  /> <?php the_post_thumbnail(); ?> 
		<?php endif; ?>
        
    
    </div>    </div>

 