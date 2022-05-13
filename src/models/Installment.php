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
		"deleted_item"         => [ "varchar(255)", "checkbox" ]
	);

	public function generate_fields( $edit = false ) {
		/**
		 * if edit create field id hidden
		 */
		if ( $edit ) {
			$installment = new Installment();
			if ( isset( $_GET['row_id'] ) && intval( $_GET['row_id'] ) > 0 ) {
				echo "<input type='hidden' name='id' value='{$_GET['row_id']}'>";
				$installment_item = $installment->find( $_GET['row_id'] );
			}
		}
		$fields = $this->columns;
		foreach ( $fields as $name => $type ) {

			$value = $edit ? $installment_item->$name : "";
			?>
            <tr valign="top">
                <th scope="row">
					<?php echo $name ?>
                </th>
                <td>
					<?php
					switch ( $type[1] ) {
						case "number":
							echo "<input type='number' name='$name' id='$name' value='$value' >";
							break;
						case "text":
							echo "<input type='text' name='$name' id='$name' value='$value'>";
							break;
						case "textarea":
							echo "<textarea name='$name' id='$name'>$value</textarea>";

							break;
						case "checkbox":
							if ( $name == $value ) {
								$check = "checked";
							} else {
								$check = "";
							}
							echo "<input type='checkbox' name='$name' id='$name' value='$name' $check >";
							break;
						case "select":
							?>

                            <select name="<?php echo $name ?>" id="<?php echo $name ?>">
								<?php $options = $type[2];
								foreach ( $options as $option ):
									?>
                                    <option value="<?php echo $option ?>" <?php if ( $value == $option )
										echo 'selected' ?>><?php echo $option ?></option>
								<?php endforeach; ?>
                            </select>
							<?php
							break;
					}
					?>
                </td>
            </tr>
			<?php

		}
	}


}
