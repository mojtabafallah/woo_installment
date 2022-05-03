<?php


namespace src\core;


use src\controllers\installmentController;


class Init {
	public static function init_menus() {
		installmentController::create_menu();
	}
}