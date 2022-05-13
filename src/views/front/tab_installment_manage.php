<?php $all_orders = wc_get_orders( [
	"customer_id" => get_current_user_id()
] );
/**
 * get max count promissory
 */
foreach ( $all_orders as $order ) {
	$items = $order->get_items();
	foreach ( $items as $item ) {
		$data_installment = \src\controllers\installmentController::get_data_price_installment( $item->get_product_id() );
//		var_dump( $data_installment );
	}
	if ( isset( $_GET['order_installment_id'] ) ) {
		echo "ok";
	}
}
?>
<table>
    <tr>
        <th>Order id</th>
        <th>Count Promissory note</th>
        <th>Max Month Promissory</th>
        <th>Price total</th>
        <th>Price paied</th>
        <th>Price remaining</th>
        <th>Price any Promissory</th>
        <th>Action</th>
    </tr>
	<?php foreach ( $all_orders as $order ): ?>
        <tr>
            <td><?php echo $order->get_id() ?></td>
            <td><?php echo $data_installment['count_promissory'] ?></td>
            <td>max</td>
            <td><?php echo wc_price( $data_installment['total_price'] ) ?></td>
            <td><?php echo wc_price( $data_installment['init_price'] ) ?></td>
            <td><?php echo wc_price( $data_installment['total_price'] - $data_installment['init_price'] ) ?></td>
            <td><?php echo wc_price( ( $data_installment['total_price'] - $data_installment['init_price'] ) / $data_installment['count_promissory'] ) ?></td>
            <td>
                <a href="<?php echo add_query_arg( [ "order_installment_id" => $order->get_id() ] ) ?>">submit</a>
            </td>
        </tr>
	<?php endforeach; ?>

</table>