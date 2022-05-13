<table>
    <tr>
        <th><?php _e( "Initial payment", MJT_WOO_INS_TRANSLATE_KEY ) ?></th>
        <th><?php _e( "Excess promissory note price", MJT_WOO_INS_TRANSLATE_KEY ) ?></th>
        <th><?php _e( "Count promissory note", MJT_WOO_INS_TRANSLATE_KEY ) ?></th>
        <th><?php _e( "Total Price", MJT_WOO_INS_TRANSLATE_KEY ) ?></th>
    </tr>
    <tr>
        <td><?php echo wc_price( $price_data['init_price'] ); ?></td>
        <td><?php echo wc_price( $price_data['promissory_price'] ); ?></td>
        <td><?php echo $price_data['count_promissory'] ?></td>
        <td><?php echo wc_price( $price_data['total_price'] ) ?></td>
    </tr>
</table>