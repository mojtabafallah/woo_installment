<?php
$max_count  = 0;
if ( isset( $_GET['order_installment_id'] ) ) {
	$order_id = $_GET['order_installment_id'];
	/**
	 * get all data installment
	 */
	$order_item = wc_get_order( $order_id );
	$items      = $order_item->get_items();

	foreach ( $items as $item ) {
		$data_installment = \src\controllers\installmentController::get_data_price_installment( $item->get_product_id() );
		if ( $data_installment['count_promissory'] > $max_count ) {
			$max_count = $data_installment['count_promissory'];
		}
	}

}
?>
<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <th>شماره سفارش</th>
            <th>شماره چک</th>
            <th>حساب بانکی</th>
            <th>آپلود</th>
        </tr>
		<?php wp_nonce_field( "send_data_installment", "nonce_field_send_data_installment" ) ?>

		<?php for ( $i = 0; $i < $max_count; $i ++ ): ?>
            <tr>
                <td><input type="text" readonly name="order_id[]" value="<?php echo $order_id ?>"></td>
                <td><input type="number" required name="n_promissory[]"></td>
                <td><input type="number" required name="number_account[]"></td>
                <td><input type="file" required name="picture[]"></td>
            </tr>
		<?php endfor; ?>

    </table>
    <input type="submit" name="send_data" value="ارسال اطلاعات">
</form>