<div class="wrap">
    <h1><?php _e( "Pivots issues", MJT_WOO_INS_TRANSLATE_KEY ); ?></h1>
    <table class="widefat">
        <thead>
        <tr>
            <th>
				<?php _e( "ID", MJT_WOO_INS_TRANSLATE_KEY ); ?>
            </th>
            <th>
				<?php _e( "Pay Type(Percent/Amount)", MJT_WOO_INS_TRANSLATE_KEY ); ?>
            </th>
            <th>
				<?php _e( "(Percent/Amount) Pay Online", MJT_WOO_INS_TRANSLATE_KEY ); ?>
            </th>
            <th>
				<?php _e( "Percentage added Czech  amount", MJT_WOO_INS_TRANSLATE_KEY ); ?>
            </th>
            <th>
				<?php _e( "Czech  Count", MJT_WOO_INS_TRANSLATE_KEY ); ?>
            </th>

            <th>
				<?php _e( "Title" ); ?>
            </th>

            <th>
		        <?php _e( "Deleted" ); ?>
            </th>
            <th>
				<?php _e( "Actions" ); ?>
            </th>
        </tr>

        </thead>
        <tbody>
		<?php
		foreach ( $all_data_model as $installment ):?>
            <tr>
                <td>
					<?php echo $installment->id ?>
                </td>
                <td>
					<?php echo $installment->pay_type ?>
                </td>
                <td>
					<?php echo $installment->online_pay ?>
                </td>
                <td>
					<?php echo $installment->percentage_bank_note ?>
                </td>
                <td>
					<?php echo $installment->count_bank_note ?>
                </td>
                <td>
					<?php echo $installment->title ?>
                </td>
                <td>
	                <?php echo $installment->deleted_item ?>
                </td>
                <td>
                    <a href="<?php echo add_query_arg( [
						'action' => 'edit',
						'row_id' => $installment->id
					] ) ?>">
						<?php _e( "Edit" ); ?>
                    </a>
                    <a onclick='return confirm("<?php _e( 'you want to delete?', MJT_WOO_INS_TRANSLATE_KEY ); ?>")'
                       href="<?php echo add_query_arg( [
						   'action' => "delete",
						   'row_id' => $installment->id
					   ] ) ?>">
						<?php _e( "Delete" ); ?>
                    </a>
                </td>
            </tr>
		<?php
		endforeach; ?>
        </tbody>
    </table>
</div>