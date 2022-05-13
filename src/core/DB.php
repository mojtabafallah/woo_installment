<?php


namespace src\core;


class DB {
	public static function create_table( $table_name, $columns ) {


		global $wpdb;
		$sql = ' CREATE TABLE IF NOT EXISTS ' . $wpdb->prefix . $table_name . ' (id int NOT NULL AUTO_INCREMENT,';
		foreach ( $columns as $name => $type ) {
			$sql .= $name . ' ' . $type[0] . ',';
		}
		$sql .= " PRIMARY KEY (id))DEFAULT CHARSET=utf8";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}

	public static function all( $table_name ) {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}{$table_name}" );
	}

	public static function add( $table_name, $data ) {
		global $wpdb;
		unset( $data['submit_add'] );
		$wpdb->insert( $wpdb->prefix . $table_name, $data );
	}

	public static function find( $table_name, $row_id ) {
		global $wpdb;

		return $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}{$table_name} WHERE id={$row_id}" );
	}

	public static function edit( $table_name, $data, $field_where = "id" ) {
		global $wpdb;
		unset( $data['submit_edit'] );
		$wpdb->update( $wpdb->prefix . $table_name, $data, array( $field_where => $data[ $field_where ] ) );

	}

	public static function delete( $table_name, $row_id ) {
		global $wpdb;
		$wpdb->delete($wpdb->prefix . $table_name,array("id"=>$row_id));
	}


}