<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="filter-panel">
    <div class="panel panel-line">
	<div class="panel-body">
		<form class="form-inline woo-ordering" role="form" method="get">
			<div class="form-group float-left">
                <label class="filter-col" style="margin-right:0;" for="pref-perpage"><?php echo __('Sort By','PixTheme')?>:</label>
				<select name="orderby" id="pref-perpage" class="form-control orderby" onchange="jQuery('.woo-ordering').submit()">
					<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php
					// Keep query string vars intact
					foreach ( $_GET as $key => $val ) {
						if ( 'orderby' === $key || 'submit' === $key ) {
							continue;
						}
						if ( is_array( $val ) ) {
							foreach( $val as $innerVal ) {
								echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
							}
						} else {
							echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
						}
					}
				?>
			</div>
			<div class="form-group float-right">
				<label class="filter-col" style="margin-right:0;" for="pref-perpage"><?php echo __('VIEW','PixTheme')?></label>
				<div class="btn-group switcher-view">
					<a href="#" id="grid" class="btn btn-default btn-sm <?php if (pixtheme_get_option('pix_category_view') == 0):?>active-btn<?php endif;?>"> <span  class="glyphicon glyphicon-th-large"></span></a>
					<a href="#" id="list" class="btn btn-default btn-sm <?php if (pixtheme_get_option('pix_category_view') == 1):?>active-btn<?php endif;?>"> <span class="glyphicon glyphicon-th-list"></span></a>
				</div>
            </div>
		</form>                
    </div> </div> </div>


