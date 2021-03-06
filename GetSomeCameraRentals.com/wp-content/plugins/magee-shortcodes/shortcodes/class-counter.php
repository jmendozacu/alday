<?php


class Magee_Counter {

	public static $args;
    private  $id;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

        add_shortcode( 'ms_counter', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args     Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string          HTML output
	 */
	function render( $args, $content = '') {

		$defaults =	Magee_Core::set_shortcode_defaults(
			array(
				'id' =>'',
				'class' =>'',
				'top_icon' => '',
				'left_icon' => '',
				'left_text' =>'',
				'counter_num' =>'',
				'right_text' =>'',
				'title'        =>'',
				'border' =>'0'
			), $args
		);
		
		extract( $defaults );
		self::$args = $defaults;
		
		if( $border == '1' )
		$class .= ' box-border';
		
		$html = '<div class="magee-counter-box '.esc_attr($class).'" id="'.esc_attr($id).'">';
		if( $top_icon )
		$html .= '<div class="counter-top-icon"><i class="fa '.esc_attr($top_icon).'"></i></div>';
		
		$html .= '<div class="counter">';
        if( $left_icon )                                      
        $html .= '<i class="fa '.esc_attr($left_icon).'"></i> '; 
		
		if( $left_text )
		$html .= '<span class="unit">'.esc_attr($left_text).'</span>';
		if( $counter_num )
		$html .= '<span class="counter-num">'.esc_attr($counter_num).'</span>';
		if( $right_text )
		$html .= '<span class="unit">'.esc_attr($right_text).'</span>';
		
        $html .= '</div>';                                             
                                                
        $html .= '<h3 class="counter-title">'.esc_attr($title).'</h3>';
        $html .= '</div>';
											
		return $html;
	} 
	
}

new Magee_Counter();