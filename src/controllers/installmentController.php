<?php

namespace src\controllers;
class installmentController {

	public static function create_menu() {
		add_action( "admin_menu", function () {
			add_menu_page(
				__( "Installment Mange", MJT_WOO_INS_TRANSLATE_KEY ),
				__( "Instalment Manage", MJT_WOO_INS_TRANSLATE_KEY ),
				"manage_options",
				"installment_manage",
				function () {
//					require_once
				} );
		} );
	}

}