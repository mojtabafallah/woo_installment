<div class="wrap">
    <h1> <?php use src\models\Installment;

		isset( $_GET['action'] ) && $_GET['action'] == "edit" ?
			_e( "Edit Installment", MJT_WOO_INS_TRANSLATE_KEY ) :
			_e( "Create Installment", MJT_WOO_INS_TRANSLATE_KEY ) ?></h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
			<?php
			$installment = new Installment();
			isset( $_GET['action'] ) && $_GET['action'] == "edit" ?
				$installment->generate_fields( true ) :
				$installment->generate_fields(  )  ?>
            <tr valign="top">
                <th scope="row">
                </th>
                <td>
                    <input class="button button-primary" name="submit_add" value="add" type="submit">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>