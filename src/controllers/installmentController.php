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
					$installment = new Installment();
					var_dump( $installment->all() );
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

}