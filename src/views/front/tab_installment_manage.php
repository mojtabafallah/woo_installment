<?php $all_orders = wc_get_orders( [
	"customer_id" => get_current_user_id()
] );
/**
 * get max count promissory
 */
//foreach ( $all_orders as $order ) {

if ( isset( $_GET['order_installment_id'] ) ) {
	if ( isset( $_POST['send_data'] ) ) {
		if ( isset( $_POST['nonce_field_send_data_installment'] ) && wp_verify_nonce( $_POST['nonce_field_send_data_installment'], "send_data_installment" ) ) {
			if ( isset( $_FILES ) ) {
				\src\controllers\fileController::upload( $_FILES, $_GET['order_installment_id'], $_POST );
			}
		} else {
			wp_die( "Error" );
		}

	}
	require_once MJT_WOO_INS_DIR_PLUGIN . "src/views/front/get_data_installment.php";
} else {
	?>
    <table>
        <tr>
            <th>شماره سفارش</th>
            <th>تعداد چک</th>
            <th>حداکثر تعداد چک</th>
            <th>مبلغ کل</th>
            <th>مبلغ پرداخت شده</th>
            <th>مبلغ باقی مانده</th>
            <th>مبلغ هر چک</th>
            <th>عملیات</th>
        </tr>
		<?php foreach ( $all_orders as $order ):
			$items = $order->get_items();
			foreach ( $items as $item ) {
				$data_installment = \src\controllers\installmentController::get_data_price_installment( $item->get_product_id() );
			}
			?>
            <tr>
                <td><?php echo $order->get_id() ?></td>
                <td><?php echo $data_installment['count_promissory'] ?></td>
                <td>w</td>
                <td><?php echo wc_price( $data_installment['total_price'] ) ?></td>
                <td><?php echo wc_price( $data_installment['init_price'] ) ?></td>
                <td><?php echo wc_price( $data_installment['total_price'] - $data_installment['init_price'] ) ?></td>
                <td><?php
					if ( $data_installment['count_promissory'] !== 0 )
						echo wc_price( ( $data_installment['total_price'] - $data_installment['init_price'] ) / $data_installment['count_promissory'] ) ?></td>
                <td>
                    <a href="<?php echo add_query_arg( [ "order_installment_id" => $order->get_id() ] ) ?>">نمایش</a>
                </td>
            </tr>
		<?php endforeach; ?>

    </table>
	<?php
//	}
}
?>
