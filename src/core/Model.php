<?php

namespace src\core;
abstract class  Model {

	protected $table_name;
	protected $columns;

	public function all() {
		return DB::all( $this->table_name );
	}

	public function add( $data ) {
		DB::add( $this->table_name, $data );

	}


}