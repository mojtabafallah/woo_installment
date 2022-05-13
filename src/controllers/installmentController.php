<?php

namespace src\controllers;

use src\core\DB;
use src\models\Installment;

class installmentController {


	public static function create_menu() {
		add_action( "admin_menu", function () {
			add_menu_page(
				__( "Installment Mange", MJT_WOO_INS_TRANSLATE_KEY ),
				__( "Instalment Manage", MJT_WOO_INS_TRANSLATE_KEY ),
				"manage_options",
				"installment_manage",
				function () {
					$installment    = new Installment();
					$all_data_model = $installment->all();
					if ( isset( $_GET['action'] ) ) {
						if ( $_GET['action'] == "delete" ) {
							if ( isset( $_GET['row_id'] ) && intval( $_GET['row_id'] > 0 ) ) {
								$item = $installment->find( $_GET['row_id'] );
								if ( $item->deleted_item == "deleted_item" ) {
									$installment->delete( $_GET['row_id'] );

								} else {
									$installment->edit( [ "id" => $_GET['row_id'], "deleted_item" => "deleted_item" ] );
								}

							}
							$all_data_model = $installment->all();
							require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/admin/installment/list.php";

							return;
						}

						if ( $_GET['action'] == "edit" ) {
							if ( isset( $_POST['submit_edit'] ) ) {
								$installment = new Installment();
								/**
								 * if not isset deleted item add to post empty
								 */
								if ( ! isset( $_POST['deleted_item'] ) ) {
									$_POST['deleted_item'] = "";
								}
								$installment->edit( $_POST );
							}
							require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/admin/installment/add.php";

							return;

						}
					}
					require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/admin/installment/list.php";
				} );
		} );

		add_action( "admin_menu", function () {
			add_submenu_page( "installment_manage",
				__( "Add Installment", MJT_WOO_INS_TRANSLATE_KEY ),
				__( "Add Installment", MJT_WOO_INS_TRANSLATE_KEY ),
				"manage_options",
				"add_installment",
				function () {
					if ( isset( $_POST['submit_add'] ) ) {
						$installment = new Installment();
						$installment->add( $_POST );
					}
					require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/admin/installment/add.php";
				}
			);
		} );
	}

	public static function create_table() {
		$installment = new Installment();
		DB::create_table( $installment->table_name, $installment->columns );
	}

	public static function create_metabox() {

		add_action( 'add_meta_boxes', function () {
			add_meta_box( 'installment',
				__( 'Installment', MJT_WOO_INS_TRANSLATE_KEY ),
				function () {
					$installment_item = new Installment();
					$installments     = $installment_item->all();
					/**
					 * if save user meta id installment
					 */
					$id_installment = get_post_meta( get_the_ID(), "installment_id", true );
					require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/admin/installment/metabox.php";
				},
				'product' );
		} );
	}

	public static function save_metabox( $product_id, $product ) {
		if ( isset( $_POST['installment'] ) ) {
			update_post_meta( $product_id, "installment_id", $_POST['installment'] );
		}

	}

	public static function data_add_to_content_product() {


		$price_data = self::get_data_price_installment( get_the_ID() );


		require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/front/data_installment.php";
	}

	public static function get_data_price_installment( $product_id ) {
		/**
		 * get product
		 */
		$product_item = wc_get_product( $product_id );

		/**
		 * get data installment
		 */
		$installment_id     = get_post_meta( $product_id, "installment_id", true );
		$installment_object = new Installment();
		$installment_item   = $installment_object->find( $installment_id );

		/**
		 * init price
		 */
		if ( $installment_item->pay_type == "price" ) {
			$init_price = $installment_item->online_pay;
		} elseif ( $installment_item->pay_type == "percent" ) {
			$init_price = ( $product_item->get_price() * ( $installment_item->online_pay / 100 ) );
		}
		/**
		 * count promissory
		 */
		$count_promissory = $installment_item->count_bank_note;

		/**
		 * price promissory
		 */
		$percent_note     = $installment_item->percentage_bank_note;
		$promissory_price = ( $product_item->get_price() - $init_price ) * ( ( $percent_note / 100 ) );

		/**
		 * total price
		 */
		$total_price = $product_item->get_price() + $promissory_price;

		return array(
			"init_price"       => $init_price,
			"count_promissory" => $count_promissory,
			"percent_note"     => $percent_note,
			"promissory_price" => $promissory_price,
			"total_price"            => $total_price
		);


	}


}