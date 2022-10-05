<?php

namespace src\core;

class Menu {
	public $page_title;
	public $menu_title;
	public $menu_slug;
	public $view;

	public function __construct( $page_title, $menu_title, $menu_slug, $view ) {
		$this->page_title = $page_title;
		$this->menu_title = $menu_title;
		$this->menu_slug  = $menu_slug;
		$this->view       = $view;

		add_action( "admin_menu", function () {
			add_menu_page( $this->page_title,
				$this->menu_title,
				"manage_options",
				$this->menu_slug,
				array( $this, "callback" ) );
		} );

	}


	public function callback() {
		require MJT_WOO_INS_DIR_PLUGIN . "src/views/menu/" . $this->view . ".php";
	}

}