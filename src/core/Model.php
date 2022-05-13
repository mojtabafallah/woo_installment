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

	public function find( $row_id ) {
		return DB::find( $this->table_name, $row_id );
	}

	public function edit( $data ) {

		DB::edit( $this->table_name, $data );
	}
	public function delete($row_id) {
		DB::delete($this->table_name, $row_id);
	}



}