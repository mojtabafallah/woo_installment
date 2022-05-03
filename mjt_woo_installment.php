<?php
/*
Plugin Name: Woo Installment
Plugin URI: https://github.com/mojtabafallah13/
Description: This plugin is designed to sell WooCommerce plugins in installments
Author: Mojtaba Fallah
Version: 1.0.0
Author URI: https://github.com/mojtabafallah13/
*/


use src\core\Init;

require_once "constants.php";
require_once "vendor/autoload.php";

class mjt_woo_installment {
	public function __construct() {
		Init::init_menus();
	}
}

new mjt_woo_installment();


