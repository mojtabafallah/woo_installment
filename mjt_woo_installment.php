<?php
/*
Plugin Name: Woo Installment
Plugin URI: https://github.com/mojtabafallah13/
Description: This plugin is designed to sell WooCommerce plugins in installments
Author: Mojtaba Fallah
Version: 1.0.0
Author URI: https://github.com/mojtabafallah13/
*/


use src\controllers\installmentController;
use src\core\Init;

require_once "constants.php";
require_once "vendor/autoload.php";

class mjt_woo_installment {
	public function __construct() {
		Init::init_menus();
		Init::init_db();
		Init::metaboxes();
		Init::bootstrap();


	}
}

new mjt_woo_installment();


function calculate_embossing_fee( $cart_object ) {
	foreach ( $cart_object->cart_contents as $item ) {
		if ( isset( $item['type_sell']['key'] ) ) {
			if ( $item['type_sell']['key'] == "installment" ) {

				if ( ! WC()->session->__isset( "reload_checkout" ) ) {
					/**
					 * get installment product
					 */
					$product_id       = $item['product_id'];
					$installment_data = installmentController::get_data_price_installment( $product_id );
					$item['data']->set_price( $installment_data['init_price'] );
				}
			}
		}


	}


}

add_action( 'woocommerce_before_calculate_totals', 'calculate_embossing_fee', 99 );

/**
 * save order
 */
add_action( 'woocommerce_thankyou', 'so_payment_complete' );
function so_payment_complete( $order_id ) {
	$order = wc_get_order( $order_id );
	//var_dump( $order );
}

/**
 * add tab to my account
 */


/**
 * 1. Register new endpoint slug to use for My Account page
 */

/**
 * @important-note    Resave Permalinks or it will give 404 error
 */
function ts_custom_add_premium_support_endpoint() {
	add_rewrite_endpoint( 'installment-manage', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'ts_custom_add_premium_support_endpoint' );


/**
 * 2. Add new query var
 */

function ts_custom_premium_support_query_vars( $vars ) {
	$vars[] = 'installment-manage';

	return $vars;
}

add_filter( 'woocommerce_get_query_vars', 'ts_custom_premium_support_query_vars', 0 );


/**
 * 3. Insert the new endpoint into the My Account menu
 */

function ts_custom_add_premium_support_link_my_account( $items ) {
	$items['installment-manage'] = __( "Installment Manage", MJT_WOO_INS_TRANSLATE_KEY );

	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'ts_custom_add_premium_support_link_my_account' );


/**
 * 4. Add content to the new endpoint
 */

function ts_custom_premium_support_content() {

	require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/front/tab_installment_manage.php";
}

/**
 * @important-note    "add_action" must follow 'woocommerce_account_{your-endpoint-slug}_endpoint' format
 */
add_action( 'woocommerce_account_installment-manage_endpoint', 'ts_custom_premium_support_content' );


function mjt_enqueue_admin_script( $hook ) {

	wp_enqueue_script( 'mjt_script_admin', MJT_WOO_INS_URL_PLUGIN . '/assets/admin/js/script-admin.js', array( "jquery" ), '1.0' );
}

add_action( 'admin_enqueue_scripts', 'mjt_enqueue_admin_script' );

function output_add_to_cart_custom_fields() {
	?>
    <div>

        <label>
            فروش نقدی
            <input type="radio" name="type_sell" value="normal" checked>
        </label>
        <label>
            فروش اقساطی
            <input type="radio" name="type_sell" value="installment">
        </label>

    </div>
	<?php
}

add_action( 'woocommerce_before_add_to_cart_button', 'output_add_to_cart_custom_fields', 10 );


// Add data to cart item
add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_data', 25, 2 );
function add_cart_item_data( $cart_item_data, $product_id ) {
	if ( ! isset( $_POST['type_sell'] ) ) {

		return $cart_item_data;
	}

	// Add the data to session and generate a unique ID
	if ( $_POST['type_sell'] == "installment" ) {
		$cart_item_data['type_sell']['key'] = "installment";

	} else {
		$cart_item_data['type_sell']['key'] = "normal";
	}

	return $cart_item_data;
}


// Display custom data on cart and checkout page.
add_filter( 'woocommerce_get_item_data', 'get_item_data', 25, 2 );
function get_item_data( $cart_data, $cart_item ) {


	if ( ! empty( $cart_item['type_sell']['key'] ) ) {

		if ( $cart_item['type_sell']['key'] == "installment" ) {
			$key = "قسطی";
		} else {
			$key = "نقدی";
		}

		$cart_data[] = array(
			'name'    => "نوع فروش",
			'display' => $key
		);
	}

	return $cart_data;
}

// Add order item meta.
add_action( 'woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 3 );
function add_order_item_meta( $item_id, $cart_item, $cart_item_key ) {
	if ( isset( $cart_item['type_sell'] ) ) {
		$values = $cart_item['type_sell']['key'];
		wc_add_order_item_meta( $item_id, __( "Option", "aoim" ), $values );
	}
}