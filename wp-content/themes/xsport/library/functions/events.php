<?php 

define( 'ROOT', get_template_directory_uri() . '/library/functions' );
define( 'IMAGES', ROOT . '/img/' );
define( 'STYLES', ROOT . '/css/' );
define( 'SCRIPTS', ROOT . '/js/' );




function pixtheme_post_type_link_filter_function_event( $post_link, $id = 0, $leavename = FALSE ) {
    if ( strpos('%event_category%', $post_link)  < 0 ) {
      return $post_link;
    }
    $post = get_post($id);
    if ( !is_object($post) || $post->post_type != 'event' ) {
      return $post_link;
    }
    $terms = wp_get_object_terms($post->ID, 'event_category');
    if ( !$terms ) {
      return str_replace('event/category/%event_category%/', '', $post_link);
    }
    return str_replace('%event_category%', $terms[0]->slug, $post_link);
}
  
add_filter('post_type_link', 'pixtheme_post_type_link_filter_function_event', 1, 3);

/**
 * Flushing rewrite rules on plugin activation/deactivation
 * for better working of permalink structure
 */
function pix_activation_deactivation() {
	pix_event_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pix_activation_deactivation' );


/**
 * Adding metabox for event information
 */
function pix_add_event_info_metabox() {
    add_meta_box(
        'pix-event-info-metabox',
        __( 'Event Info', 'uep' ),
        'pix_render_event_info_metabox',
        'event',
        'side',
        'core'
    );
}
add_action( 'add_meta_boxes', 'pix_add_event_info_metabox' );


/**
 * Rendering the metabox for event information
 * @param  object $post The post object
 */
function pix_render_event_info_metabox( $post ) {
 
    // generate a nonce field
    wp_nonce_field( basename( __FILE__ ), 'pix-event-info-nonce' );
 
    // get previously saved meta values (if any)
    $event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
    $event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
    $event_venue = get_post_meta( $post->ID, 'event-venue', true );
	$event_img_size = get_post_meta( $post->ID, 'event-img-size', true );
	$event_img_position = get_post_meta( $post->ID, 'event-img-position', true );
	$event_link = get_post_meta( $post->ID, 'event-link', true );
 	
    // if there is previously saved value then retrieve it, else set it to the current time
    $event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();
 
    //we assume that if the end date is not present, event ends on the same day
    $event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;
 
    ?>
 
<label for="pix-event-start-date"><?php _e( 'Event Start Date:', 'uep' ); ?></label>
        <input class="widefat pix-event-date-input" id="pix-event-start-date" type="text" name="pix-event-start-date" placeholder="Format: February 23, 2015" value="<?php echo esc_attr(date( 'F d, Y', $event_start_date )); ?>" />
 
<label for="pix-event-end-date"><?php _e( 'Event End Date:', 'uep' ); ?></label>
        <input class="widefat pix-event-date-input" id="pix-event-end-date" type="text" name="pix-event-end-date" placeholder="Format: February 23, 2015" value="<?php echo esc_attr(date( 'F d, Y', $event_end_date )); ?>" />
 
<label for="pix-event-venue"><?php _e( 'Event Venue:', 'uep' ); ?></label>
        <input class="widefat" id="pix-event-venue" type="text" name="pix-event-venue" placeholder="eg. Times Square" value="<?php echo esc_attr($event_venue); ?>" />
        
<label for="pix-img-size"><?php _e( 'Event Image Size:', 'uep' ); ?></label>
	<select class="widefat" id="pix-img-size" name="pix-img-size" >
    	<option <?php if(!$event_img_size) echo "selected"; ?> value="">Big</option>
        <option <?php if($event_img_size) echo "selected"; ?> value="cd-events-item-small">Small</option>
    </select>

<label for="pix-event-img-position"><?php _e( 'Event Image Position:', 'uep' ); ?></label>
	<select class="widefat" id="pix-img-position" name="pix-img-position" >
    	<option <?php if(!$event_img_position) echo "selected"; ?> value="">Left</option>
        <option <?php if($event_img_position) echo "selected"; ?> value="item-f-right">Right</option>
    </select>
    
<label for="pix-event-link"><?php _e( 'Event Link:', 'uep' ); ?></label>
        <input class="widefat" id="pix-event-link" type="text" name="pix-event-link" placeholder="eg. http://themeforest.net/" value="<?php echo esc_attr($event_link); ?>" />
 
<?php  

}


/**
 * Enqueueing scripts and styles in the admin
 * @param  int $hook Current page hook
 */
function pix_admin_script_style( $hook ) {
 	global $post_type;
	
    if ( ( 'post.php' == $hook || 'post-new.php' == $hook ) && ( 'event' == $post_type ) ) {
        wp_enqueue_script(
            'pix-events',
            SCRIPTS . 'script.js',
            array( 'jquery', 'jquery-ui-datepicker' ),
            '1.0',
            true
        );
 
        wp_enqueue_style(
            'jquery-ui-calendar',
            STYLES . 'jquery-ui-1.10.4.custom.min.css',
            false,
            '1.10.4',
            'all'
        );
    }
}
add_action( 'admin_enqueue_scripts', 'pix_admin_script_style' );


/**
 * Enqueueing styles for the front-end widget
 */
function pix_widget_style() {
	if ( is_active_widget( '', '', 'pix_upcoming_events', true ) ) {
		wp_enqueue_style(
			'upcoming-events',
			STYLES . 'style.css',
			false,
			'1.0',
			'all'
		);
	}
}
add_action( 'wp_enqueue_scripts', 'pix_widget_style' );


/**
 * Saving the event along with its meta values
 * @param  int $post_id The id of the current post
 */
function pix_save_event_info( $post_id ) {
 
    // checking if the post being saved is an 'event',
    // if not, then return
    if ( empty($_REQUEST['post_type']) || 'event' != $_REQUEST['post_type'] ) {
        return;
    }
 
    // checking for the 'save' status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST['pix-event-info-nonce'] ) && ( wp_verify_nonce( $_POST['pix-event-info-nonce'], basename( __FILE__ ) ) ) ) ? true : false;
 
    // exit depending on the save status or if the nonce is not valid
    if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
        return;
    }
 		
    // checking for the values and performing necessary actions
    if ( isset( $_POST['pix-event-start-date'] ) ) {
        update_post_meta( $post_id, 'event-start-date', strtotime( $_POST['pix-event-start-date'] ) );
    }
 
    if ( isset( $_POST['pix-event-end-date'] ) ) {
        update_post_meta( $post_id, 'event-end-date', strtotime( $_POST['pix-event-end-date'] ) );
    }
 
    if ( isset( $_POST['pix-event-venue'] ) ) {
        update_post_meta( $post_id, 'event-venue', sanitize_text_field( $_POST['pix-event-venue'] ) );
    }
	
	if ( isset( $_POST['pix-img-size'] ) ) {
        update_post_meta( $post_id, 'event-img-size', sanitize_text_field( $_POST['pix-img-size'] ) );
    }
	
	if ( isset( $_POST['pix-img-position'] ) ) {
        update_post_meta( $post_id, 'event-img-position', sanitize_text_field( $_POST['pix-img-position'] ) );
    }
	
	if ( isset( $_POST['pix-event-link'] ) ) {
        update_post_meta( $post_id, 'event-link', sanitize_text_field( $_POST['pix-event-link'] ) );
    }
}
add_action( 'save_post', 'pix_save_event_info' );


?>