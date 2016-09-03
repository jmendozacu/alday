

    <p><?php echo pixtheme_limit_words(get_the_excerpt(), 20) ?></p>
    <div id="custom-text-<?php echo esc_attr($post->ID); ?>" style="display:none;"><?php echo get_post_meta( get_the_ID(), 'post_custom', true ); ?></div>
   <div class="price-box"> 
   
    <a    href="#custom-text-<?php echo esc_attr($post->ID); ?>" class="btn-icon prettyPhoto"  >
      <span class="hb hb-sm"><span class="amount"><i class="fa fa-pencil icon-large"></i></span></span>    
    </a>
</div></div>

