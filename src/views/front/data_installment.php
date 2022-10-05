

<table>

    <tr>
        <th>پرداخت اولیه</th>
        <th> مبلغ افزوده برای چک</th>
        <th> تعداد چک</th>
        <th>مبلغ کل</th>
    </tr>
    <tr>
        <td><?php echo wc_price( $price_data['init_price'] ); ?></td>
        <td><?php echo wc_price( $price_data['promissory_price'] ); ?></td>
        <td><?php echo $price_data['count_promissory'] ?></td>
        <td><?php echo wc_price( $price_data['total_price'] ) ?></td>
    </tr>
</table>