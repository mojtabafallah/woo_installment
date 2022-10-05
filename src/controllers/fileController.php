<?php


namespace src\controllers;


use src\core\DB;
use src\models\File;

class fileController {
	public static function create_table() {
		$file = new File();
		DB::create_table( $file->table_name, $file->columns );
	}

	public static function upload( $file_item, $installment_id, $data ) {

		/**
		 * upload file in media wordpress
		 */
		if ( isset( $file_item ) ) {
			$count = count( $file_item['picture']['name'] );
			var_dump( $count );
			for ( $i = 0; $i < $count - 3; $i ++ ) {


				$file = wp_upload_bits( $file_item['picture']['name'][ $i ], null, @file_get_contents( $file_item['picture']['tmp_name'][ $i ] ) );

				$data1    = array(
					"order_id"            => $data['order_id'][ $i ],
					"user_id"             => get_current_user_id(),
					"url"                 => $file['url'],
					"installment_id"      => $installment_id,
					"number_bank_account" => $data['number_account'][ $i ],
					"number_promissory"   => $data['n_promissory'][ $i ]
				);
				$file_obj = new File();

				$file_obj->add( $data1 );
			}

		}


	}

}


