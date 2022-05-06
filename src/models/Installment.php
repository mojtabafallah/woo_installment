<?php

namespace src\models;

use src\core\DB;
use src\core\Model;

class Installment extends Model {

	public $table_name = "installment";
	public $columns = array(
		"pay_type"             => [ "varchar(255)", "select", [ "percent", "price" ] ],
		"online_pay"           => [ "int", "number" ],
		"percentage_bank_note" => [ "int", "number" ],
		"count_bank_note"      => [ "int", "number" ],
		"title"                => [ "varchar(255)", "text" ],
		"description"          => [ "text", "textarea" ],
		"deleted"              => [ "boolean", "checkbox" ]
	);

	public function generate_fields( $true = true ) {
		$fields = $this->columns;
		foreach ( $fields as $name => $type ) {
			switch ( $type[1] ) {
				case "number":
					?>
                    <tr valign="top">
                        <th scope="row">
							<?php echo $name ?>
                        </th>
                        <td>
							<?php echo "<input type='number' name='$name' id='$name'>"; ?>
                        </td>
                    </tr>
					<?php


					break;
				case "text":
					?>
                    <tr valign="top">
                        <th scope="row">
							<?php echo $name ?>
                        </th>
                        <td>
							<?php echo "<input type='text' name='$name' id='$name'>"; ?>
                        </td>
                    </tr>
					<?php
					break;
				case "textarea":
					?>
                    <tr valign="top">
                        <th scope="row">
							<?php echo $name ?>
                        </th>
                        <td>
							<?php echo "<textarea name='$name' id='$name'></textarea>"; ?>
                        </td>
                    </tr>
					<?php

					break;
				case "checkbox":
					?>
                    <tr valign="top">
                        <th scope="row">
							<?php echo $name ?>
                        </th>
                        <td>
							<?php echo "<input type='checkbox' name='$name' id='$name'>"; ?>
                        </td>
                    </tr>
					<?php
					break;
				case "select":
					?>
                    <tr valign="top">
                        <th scope="row">
							<?php echo $name ?>
                        </th>
                        <td>
                            <select name="<?php echo $name ?>" id="<?php echo $name ?>">
								<?php $options = $type[2];
								foreach ( $options as $option ):
									?>
                                    <option value="<?php echo $option ?>"><?php echo $option ?></option>
								<?php endforeach; ?>

                            </select>

                        </td>
                    </tr>
					<?php
					break;

			}

		}
	}


}
