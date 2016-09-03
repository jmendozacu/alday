<?php
	global $post;
	// get meta options/values
	$pixtheme_content = rwmb_meta('post_quote_content');
	$pixtheme_source = rwmb_meta('post_quote_source');
	$pixtheme_format  = get_post_format();
	$pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? "standared" : $pixtheme_format;
	$icon = array("standared" => "icon-picture", "quote" => "fa fa-pencil", "gallery" => "icon-camera", "video" => "fa fa-video-camera");
	$post_date = strtotime($post->post_date);
?>


<div class="entry-media">

<div class="box-date-post"><?php echo sprintf('<span class="date-1">%d</span> <span class="date-2">%s</span>',esc_attr(date('d',$post_date)),esc_attr(date('F',$post_date)))?></div>

<div class="entry-thumbnail">


<div class="post-type-media type-image"><i class="<?php echo esc_attr($icon[$pixtheme_format]); ?>"></i> </div>


		<div class="blockquote">
	
			<p><?php echo wp_kses_post($pixtheme_content); ?></p>
			
            
            <span class="blockquote-autor"><?php echo wp_kses_post($pixtheme_source); ?></span>
            
            
		</div>

</div>


</div>