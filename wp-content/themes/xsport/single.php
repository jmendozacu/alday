<?php
/**
 * The Template for displaying all single posts.
 */
$custom =  get_post_custom(get_queried_object()->ID);
$layout = isset ($custom['pix_page_layout']) ? $custom['pix_page_layout'][0] : '2';
$sidebar = isset ($custom['pix_selected_sidebar'][0]) ? $custom['pix_selected_sidebar'][0] : 'Blog Sidebar';
$pix_options = get_option('pix_general_settings');

get_header(); 
	
?>

<main class="section" id="main">
  <div class="container">
    <div class="row">
      <?php if ($layout == '3'):?>
        <div class="col-xs-12 col-sm-12 col-md-3">
        <aside class="sidebar">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
          <?php   endif;?>
        </aside>
      </div>
      <?php endif?>
      <div class="col-xs-12 col-sm-7 <?php if ($layout == '1'):?>col-md-12<?php else:?>col-md-9<?php endif;?>">
        <section role="main" class="main-content">
          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php esc_attr(the_ID());?>"<?php post_class('post format-image clearfix'); ?>>
            <?php			
                    $pixtheme_format  = get_post_format();
                    $pixtheme_format = !in_array($pixtheme_format, array("quote", "gallery", "video")) ? 'standared' : $pixtheme_format;
					$icon = array("standared" => "icon-picture", "quote" => "fa fa-pencil", "gallery" => "icon-camera", "video" => "fa fa-video-camera");
                    get_template_part( 'template-parts/post-format/blog', $pixtheme_format);
                    get_template_part( 'template-parts/blog-template/blog', 'template-single');
                ?>
            <div class="entry-main">
              <h3 class="entry-title">
                <?php the_title(); ?>
              </h3>
              <div class="entry-content">
                <?php the_content(); ?>
              </div>
            </div>
            <div class="entry-footer footer-panel">
              <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
              <?php $categories = get_the_category($post->ID);
			  		$posttags = get_the_tags($post->ID);
							  		
					if($categories){
						$output = '<div class="tag-icon"><i class="fa fa-list-alt"></i> </div><ul class="tag-cloud unstyled clearfix"> ';						
						foreach($categories as $category) {
							$output .= '<li><a href="'.esc_url(get_category_link( $category->term_id )).'" >'.$category->cat_name.'</a></li>';
						}
						$output .= '</ul>';
						echo wp_kses_post($output);						
					}
					if ($posttags) {
						$output = '<div class="tag-icon"><i class="fa fa-tags"></i> </div><ul class="tag-cloud unstyled clearfix">';
						foreach($posttags as $tag) {
							$output .= '<li><a href="'.esc_url(get_tag_link( $tag->term_id )).'" >'.$tag->name.'</a></li>';
						}
						$output .= '</ul>';
						echo wp_kses_post($output);
					}
			  ?>
              <?php endif; // End if 'post' == get_post_type()?>
              <?php wp_link_pages();?>
              <?php /*?><div class="date-info">
                <ul class="unstyled clearfix">
                  <?php if( 'open' == $post->comment_status && $pix_options['pix_blog_show_comments']) : ?>
                  <li> <span aria-hidden="true" class="icon-bubbles"></span>
                    <?php comments_popup_link( __( '0 Comments', 'PixTheme' ), __( '1 Comment', 'PixTheme' ), __( '% Comments', 'PixTheme' )); ?>
                  </li>
                  <?php endif?>
                  <?php if($pix_options['pix_blog_show_date']): ?>
                  <li> <span aria-hidden="true" class="icon-clock"></span><?php echo get_the_time('M d, Y'); ?></li>
                  <?php endif?>
                </ul>
              </div><?php */?>
            </div>
          </article>
        </section>
        <?php 
			$get_avatar = get_avatar(get_the_author_meta('user_email'), 85);
			preg_match("/src='(.*?)'/i", $get_avatar, $matches);
			$src = !empty($matches[1]) ? $matches[1] : '';
		?>
        <section class="about-autor">
          <div class="comments-header">
            <?php _e('About Author', 'PixTheme')?>
          </div>
          <article class="comment img">
            <div class="avatar-review "> <img src="<?php echo esc_url($src) ?>" alt="<?php _e('About Author', 'PixTheme')?>"/> </div>
            <header class="comment-header"> <cite class="comment-author">
              <?php the_author_posts_link(); ?>
              </cite>
              <time class="comment-datetime" datetime="2012-10-27"><span class="icon-clock" aria-hidden="true"></span> <?php echo date_i18n( get_option('date_format'), strtotime( get_the_author_meta( 'user_registered') ) ); ?> </time>
            </header>
            <div class="comment-body">
              <?php the_author_meta( 'description'); ?>
            </div>
          </article>
        </section>
        <?php
  	$args = array(
		'author'        =>  get_the_author_meta( 'ID'), 
		'orderby'       =>  'post_date',
		'order'         =>  'ASC',
		'posts_per_page'=> 4 
    );
	$author_posts = get_posts( $args );

	if(!empty($author_posts) && count($author_posts) > 2) :
  ?>
        <section class="about-autor">
          <div class="comments-header">
            <?php _e('author posts  ', 'PixTheme') ?>
          </div>
          <div class="padding25">
            <div class="row">
              <?php foreach($author_posts as $apost){ ?>
              <?php $tumbnail = get_the_post_thumbnail( $apost->ID ) != '' ? get_the_post_thumbnail( $apost->ID ) : '<img src="'.esc_url(get_template_directory_uri()).'/images/noimage.jpg">'; ?>
              <div class="  col-lg-3 col-md-3  col-sm-6 col-xs-6   ">
                <div class="box-simple-image"> <a href="<?php echo esc_url(get_permalink( $apost->ID )); ?>"> <?php echo wp_kses_post($tumbnail); ?> </a></div>
              </div>
              <?php } ?>
            </div>
          </div>
        </section>
        <?php endif; ?>
        <div class="section-comment">
          <?php comments_template(); ?>
          <?php $test = false; if ($test) {comment_form(); } ?>
        </div>
        <?php endwhile; ?>
      </div>
      <?php if ($layout == '2'):?>
       <div class="col-xs-12 col-sm-12 col-md-3">
        <aside class="sidebar">
          <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?>
          <?php   endif;?>
        </aside>
      </div>
      <?php endif?>
    </div>
  </div>
</main>
<?php get_footer();?>
