<?php 


global $post;
$out = $css_class = $cnt = '';

extract(shortcode_atts(array(
	'count'=>'',
	'css_animation' => '',				
), $atts));

$css_class .= $this->getCSSAnimation($css_animation);

$args = array(
	'posts_per_page'   => $count,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => '',
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_array = get_posts( $args );

 ?>
 
<?php for( $i=0; $i < sizeof($posts_array); $i++ ):
	$post = $posts_array[$i]; 
	setup_postdata($post);
	$pixtheme_content = rwmb_meta('post_quote_content');
	$pixtheme_source = rwmb_meta('post_quote_source');
	$pixtheme_format = get_post_format();
	$pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? "standared" : $pixtheme_format;
	$icon = array("standared" => "icon-picture", "quote" => "fa fa-pencil", "gallery" => "icon-camera", "video" => "fa fa-video-camera");
?>
<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12">
 	<div class="blog-post blog-post-home">
	 	<div class="box-date-post">
	 		<?php echo sprintf('<span class="date-1">%d</span> <span class="date-2">%s</span>',esc_attr(date('d',strtotime($post->post_date))),esc_attr(date('F',strtotime($post->post_date))))?>	 		
	 	</div>
	 	<div class="post-home-image">
		 	<div class="thumbnail">
			 	<div class="post-type-media type-image"><i class="<?php echo esc_attr($icon[$pixtheme_format]); ?>"></i></div>
			 	<?php if ( has_post_thumbnail() && $pixtheme_format != 'quote'):?>  
		        
		        
			 		<?php the_post_thumbnail(); ?> 
		            
		            
		        <?php elseif($pixtheme_format == 'quote'):?>  
		        	<div class="blockquote">
						<p><?php echo wp_kses_post($pixtheme_content); ?></p>					
			            <span class="blockquote-autor"><?php echo wp_kses_post($pixtheme_source); ?></span>
					</div>  
				<?php else : ?>
		        	<img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/noimage.jpg"  /> <?php get_the_post_thumbnail(); ?> 
				<?php endif; ?>
			 </div>
		</div>
		<div class="caption">
			<a  href="<?php esc_url(the_permalink())?>">
				<h2 class="blog-post-title"><?php the_title()?></h2>
			</a>
			 <?php $content = get_the_content();
			  $trimmed_content = wp_trim_words( $content, 60); ?>
			  <p><?php echo esc_html($trimmed_content); ?></p>
			<div class="blog-post-panel">
				<a class="blog-view-more btn btn-default button button-small" href="<?php esc_url(the_permalink())?>"><?php echo __('read more','PixTheme')?></a> 
			</div>
		</div>
	</div>
</div>

<?php endfor;?>

