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
				<?php _e( "Actions" ); ?>
            </th>
        </tr>

        </thead>
        <tbody>
		<?php
		foreach ( $all_data_model as $category ):?>
            <tr>
                <td>
					<?php echo $category->id ?>
                </td>
                <td>
					<?php echo $category->title ?>
                </td>
                <td>
                    <a href="<?php echo add_query_arg( [
						'item'   => Category::$item,
						'action' => 'edit',
						'id_row' => $category->id
					] ) ?>">
						<?php _e( "Edit" ); ?>
                    </a>
                    <a onclick='return confirm("<?php _e( 'you want to delete?', "kias_zephyr" ); ?>")'
                       href="<?php echo add_query_arg( [
						   'item'   => Category::$item,
						   'action' => "delete",
						   'id_row' => $category->id
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