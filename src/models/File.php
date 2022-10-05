<?php


namespace src\models;


use src\core\Model;

class File extends Model {
	public $table_name = "file";
	public $columns = array(
		"order_id"            => [ "int", "number" ],
		"installment_id"      => [ "int", "number" ],
		"user_id"             => [ "int", "number" ],
		"url"                 => [ "text", "textarea" ],
		"number_bank_account" => [ "varchar(255)", "text" ],
		"number_promissory"   => [ "varchar(255)", "text" ],
	);

}