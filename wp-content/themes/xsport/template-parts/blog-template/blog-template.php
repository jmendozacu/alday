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

$pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? "standared" : $pixtheme_format;
$icon = array("standared" => "icon-picture", "quote" => "fa fa-pencil", "gallery" => "icon-camera", "video" => "fa fa-video-camera");
	
?>

<div class="entry-main">
 
  <h3 class="entry-title"> <a href="<?php esc_url(the_permalink())?>">
    <?php the_title() ?>
    </a> </h3>
  <div class="entry-content"> <?php echo do_shortcode(get_the_excerpt()); ?> </div>
  <div class="entry-footer">
    <div class="entry-meta clearfix">
      <?php /*?><ul class="unstyled clearfix">
        <?php if( 'open' == $post->comment_status && $pix_options['pix_blog_show_comments']) : ?>
        <li> <span aria-hidden="true" class="icon-bubbles"></span>
          <?php comments_popup_link( __( '0 Comments', 'PixTheme' ), __( '1 Comment', 'PixTheme' ), __( '% Comments', 'PixTheme' )); ?>
        </li>
        <?php endif?>
		
      </ul><?php */?>
	  <?php if($pix_options['pix_blog_show_date']): ?>
        <li> <span aria-hidden="true" class="icon-clock"></span><?php echo get_the_time('M d, Y'); ?></li>
        <?php endif?>
    </div>
    <div class="entry-footer"> <a title="<?php esc_attr(the_title()) ?>" class="view-post-btn" href="<?php esc_url(the_permalink())?>">
       <?php echo pixtheme_get_theme_generator('pixtheme_post_read_more') ?>
      </a> </div>
  </div>
</div>
