<?php


namespace src\core;


use src\controllers\installmentController;


class Init {
	public static function init_menus() {
		installmentController::create_menu();
	}

	public static function init_db() {
		installmentController::create_table();
	}

	public static function metaboxes() {
		installmentController::create_metabox();
		add_action( "save_post_product", array( installmentController::class, "save_metabox" ), 10, 3 );
	}

	public static function bootstrap() {
		add_action("woocommerce_single_product_summary",array(installmentController::class,"data_add_to_content_product"),70);
	}
}