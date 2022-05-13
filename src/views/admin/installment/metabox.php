<select name="installment" id="installment">
    <option value=""><?php _e( "Select Installment", MJT_WOO_INS_TRANSLATE_KEY ) ?></option>
	<?php
	$select_item = get_post_meta( get_the_ID(), "installment_id", true );
	foreach ( $installments as $installment ): ?>
        <option value="<?php echo $installment->id ?>" <?php echo $select_item == $installment->id ? "selected" : "" ?>>
			<?php echo $installment->title ?>
        </option>
	<?php endforeach; ?>

</select>