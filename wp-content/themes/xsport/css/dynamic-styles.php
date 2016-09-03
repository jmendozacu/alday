<?php header("Content-type: text/css; charset: UTF-8"); 
global $woocommerce;
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$pix_options = get_option('pix_general_settings');
$pix_customize = get_option( 'pix_customize_options' );
$pix_woo = wc_get_image_size( 'shop_catalog' );

?>
<?php if($pix_customize['first_color'] != ''):?>


html .yamm.navbar-default, html .yamm.navbar-default li.active, html .box-date-post, html .btn-primary, html .tag-cloud li:hover, html .category-list li:hover, html .ft-box:hover, html .x-item-wrap .details, html .x-item-wrap .details:after, html .service-icon:after, html .icon-ft-list:after, html #filter li a:after, html .btn-icon, html .slide-desc:after, html #cd-team li:hover .staff-wrap, html #cd-team li:hover .staff-position, html #cd-team li:hover .cd-member-info:after, html .social-team li a:after, html #contactForm .btn-xl, html .table-line:hover .price-plan-wrap h3, html .table-line.active .price-plan-wrap h3, html .table-line:hover .ptable-offer-button, html .table-line.active .ptable-offer-button, html .btn-action-item a:hover, html .cd-events-wrapper .flex-direction-nav li:hover a, html .cd-submit, html .x-carousel li:after, html .primary-color, html .promo-item:hover .promo-caption, .x-navigation .btn-danger, html .blog-post-panel .btn:hover, html .subcategory-list .sub-heading, html .active-btn, html .active-btn, html .popover-shorty .panel-footer .btn, .product-button-group .btn-danger, html .view-post-btn:hover {
	background-color: <?php echo esc_attr($pix_customize['first_color'])?>;
}
html .breadcrumb > .active, html .fot-title, html .blockquote-quote .fa-quote-left, html .blockquote-quote .fa-quote-right, html .avatar-about h4, html .service-item:hover h4, html .autor-date .fa, html .small-logo, html .price-regular-single, html .comment-datetime span[class*="icon-"] {
	color: <?php echo esc_attr($pix_customize['first_color'])?>;
}
html .box-date-post:before, html blockquote, html .social-box .social-links li a:before, html .btn-primary, .yamm .dropdown-menu h5:before, .blockquote-title:before, html .outline-outward:before, html .outline-outward.btn-icon:before, html .icon-set-wrap .icon-set, html .table-line:hover .ptable-offer-button:after, html .table-line.active .ptable-offer-button:after, html .cd-events-wrapper .flex-direction-nav li:hover a, html .ft-list li:hover .icon-ft-list, .x-navigation .btn-danger, .popover-shorty .panel-footer .btn {
	border-color: <?php echo esc_attr($pix_customize['first_color'])?>;
}
html body .navbar-default .navbar-nav > .active > a, html body .navbar-default .navbar-nav > .active > a:hover, html body .navbar-default .navbar-nav > .active > a:focus, html .yamm.navbar-default .navbar-nav > li:hover > a {
	box-shadow: 1px 0 10px 6px #69A031 inset;
}
.ip-header .ip-loader svg path.ip-loader-circle {
	stroke: <?php echo esc_attr($pix_customize['first_color'])?> ; 
}

html body .navbar-default .navbar-nav > .active > a, html body .navbar-default .navbar-nav > .active > a:hover, html body .navbar-default .navbar-nav > .active > a:focus, html .yamm.navbar-default .navbar-nav > li:hover > a {
    box-shadow: none;
    opacity: 0.6;
}

html .wpcf7-submit {
  background: <?php echo esc_attr($pix_customize['first_color'])?>;
}

html .home-section .fot-contact i {
  border-color:  <?php echo esc_attr($pix_customize['first_color'])?> !important;
}

html  .home-section .mc4wp-form button{
	  background: <?php echo esc_attr($pix_customize['first_color'])?>;
}

html   .home-section .mc4wp-form button:after {
  border-color:  <?php echo esc_attr($pix_customize['first_color'])?> ;
}


html .woocommerce div.product p.price, .woocommerce div.product span.price {
  color: <?php echo esc_attr($pix_customize['first_color'])?> ;
}

html .woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
  background-color: <?php echo esc_attr($pix_customize['first_color'])?>;

}


html #tribe-bar-form .tribe-bar-submit input[type=submit] {
  background: <?php echo esc_attr($pix_customize['first_color'])?>;
  }
    
    .btn-action-item a i {
  color:#fff !important;
}
    
html .pagination li.current a, .woocommerce-pagination .current {
  background-color:<?php echo esc_attr($pix_customize['first_color'])?>;
  border-color: <?php echo esc_attr($pix_customize['first_color'])?>;
}

  <?php endif?>
  <?php if($pix_customize['second_color'] != ''):?>
  
  
 html  .woocommerce #respond input#submit.alt, html  .woocommerce a.button.alt, html  .woocommerce button.button.alt, html  .woocommerce input.button.alt {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?> ;
  border-color: <?php echo esc_attr($pix_customize['second_color'])?> ;
}

 html  .popover-shorty .panel-footer .btn-cart {
  border:<?php echo esc_attr($pix_customize['second_color'])?>  !important;
  background: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
}

 html  .tp-button.orange {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
  color:#fff !important ;
}

.section-subheading {
  background: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
  }

.btn-action-item a.btn-cart {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  }
  
  
 html  .ft-box:hover i {
  color: <?php echo esc_attr($pix_customize['second_color'])?> ;
}
  
  
  html  .ft-box:hover {
  border-color: <?php echo esc_attr($pix_customize['second_color'])?> ;
}

  html .service-item:hover .service-icon:after {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?>;
}


html .x-item-wrap .details .fa-box-arrow:hover {
  background:<?php echo esc_attr($pix_customize['second_color'])?>;
  border-color: <?php echo esc_attr($pix_customize['second_color'])?>;
}

html .blockquote-title {
  border-left-color: <?php echo esc_attr($pix_customize['second_color'])?>;
  }
  
 html  #filter li a.current:after {
  background: <?php echo esc_attr($pix_customize['second_color'])?>;
}

.box-date-post:after {

  border-top-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  border-right-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  }
  
  
  html .comments-header:after {
 
  border-top-color: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
  border-right-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  right: 3px;
  position: absolute;
  top: 3px;
}
  
  
  html .cd-img-overlay .x-hover:after {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  }
  
  
  html #cd-team li > a:hover {


  border-color:  <?php echo esc_attr($pix_customize['second_color'])?> !important;
  background:  <?php echo esc_attr($pix_customize['second_color'])?> !important;
}


html .ptable-more-info , html .ptable-phone {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?>;
  }
  
 .type-post.sticky:after {
  color: <?php echo esc_attr($pix_customize['second_color'])?>;
  }
  
  
  html .heading-wrap-style-2 .section-heading {
 color: <?php echo esc_attr($pix_customize['second_color'])?>;
  }
  
  html body .events-content .events-date {
 color: <?php echo esc_attr($pix_customize['second_color'])?>;
  }
  
  html .cd-see-all {
  background: <?php echo esc_attr($pix_customize['second_color'])?>;
  }
  
  html .blog-post-panel .btn:before {
  border-right-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  border-top-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
}

  html body  .heading-wrap .section-subheading-simple {
  color: <?php echo esc_attr($pix_customize['second_color'])?>;
 
}

  html body .tribe-events-meta-group .tribe-events-single-section-title:before , html body  #tribe-events .tribe-events-button:before,  html body .tribe-events-button:before {
 
  border-top-color: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
  border-right-color: <?php echo esc_attr($pix_customize['second_color'])?>  !important;

}
  
  html .view-post-btn:before {
  border-top-color: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
  border-right-color: <?php echo esc_attr($pix_customize['second_color'])?>  !important;
  }

 html  aside .widget > ul li:before, html aside .widget.woocommerce > ul li:before {
  border-top-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  border-right-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  }
  
  html  .widget-title:before {
 
  border-top-color:  <?php echo esc_attr($pix_customize['second_color'])?> !important;
  border-right-color:  <?php echo esc_attr($pix_customize['second_color'])?> !important;
  }
  
  
  html .x-hover-box li a:hover, .footer .widget li a:hover{
   background-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
   color:#fff !important ;
  }
  
  
  
  html .woocommerce .widget_price_filter .price_slider_amount .button {
  background:  <?php echo esc_attr($pix_customize['second_color'])?>;
}

html .tagcloud a:hover {
  background-color: <?php echo esc_attr($pix_customize['second_color'])?> !important;
  color:#fff !important;
}
  
  <?php endif?>
  <?php if($pix_customize['font_family'] != ''):?>
html body {
    font-family: '<?php echo esc_attr($pix_customize['font_family'])?>';
    font-weight: <?php echo esc_attr($pix_customize['font_weight'])?>;    
}
    <?php endif?>
    <?php if($pix_customize['font_title_family'] != ''):?>
html h1, html  h2, html  h3,  html  h4, html  h5, html  h6,{
    font-family: '<?php echo esc_attr($pix_customize['font_title_family'])?>';
    font-weight:<?php echo esc_attr($pix_customize['font_title_weight'])?>;
}
    <?php endif?>
    <?php if($pix_woo['width']):?>
    <?php /*?>#pix-shop .isotope-frame .x-item {
    width: <?php echo esc_attr($pix_woo['width'])?>px; 
}<?php */?>
    <?php endif?>
    <?php if($pix_woo['height']):?>
#pix-shop  .portfolio-image {
<?php /*?> height: <?php echo esc_attr($pix_woo['height'])?>px;<?php */?>
}
<?php endif?>
<?php if($pix_options['pix_portfolio_width']):?>
#pix-portfolio .isotope-frame .x-item  {
<?php /*?>    width: <?php echo esc_attr($pix_options['pix_portfolio_width'])?>px;<?php */?>
<?php /*?>   height: <?php echo esc_attr($pix_options['pix_portfolio_height'])?>px;<?php */?>
}
<?php endif?>
<?php if($pix_options['pix_portfolio_height']):?>
#pix-portfolio  .portfolio-image , #pix-portfolio .isotope-frame .x-item {
<?php /*?>  height: <?php echo esc_attr($pix_options['pix_portfolio_height'])?>px ;<?php */?>
}
<?php endif?>
<?php if($pix_options['pix_custom_css']):?>
<?php echo esc_html($pix_options['pix_custom_css']) ?>
<?php endif?>
