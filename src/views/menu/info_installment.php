<?php

use src\models\File;
$file=new File();

if (isset($_GET['action']))
{
    if ($_GET['action']=="delete")
    {

        $file->delete($_GET['row_id']);
    }
}
$all_data_model = $file->all();
?>
<div class="wrap">
    <h1>لیست اطلاعات فروش اقساطی</h1>
    <table class="widefat">
        <thead>
        <tr>
            <th>
                شناسه
            </th>
            <th>
                شماره سفارش
            </th>
            <th>
                کاربر
            </th>
            <th>
                چک
            </th>
            <th>
                شماره چک
            </th>
            <th>
                شماره حساب
            </th>
            <th>
				<?php _e( "Actions" ); ?>
            </th>
        </tr>

        </thead>
        <tbody>
		<?php
		foreach ( $all_data_model as $file ):?>
            <tr>
                <td>
					<?php echo $file->id ?>
                </td>
                <td>
					<?php  echo $file->order_id ?>
                </td>
                <td>
					<?php echo $file->user_id ?>
                </td>
                <td>
	                <a href="<?php echo $file->url ?>">دانلود</a>
                </td>
                <td>
					<?php echo $file->number_promissory ?>
                </td>
                <td>
					<?php echo $file->number_bank_account ?>
                </td>

                <td>
                    <a onclick='return confirm("<?php _e( 'you want to delete?', MJT_WOO_INS_TRANSLATE_KEY ); ?>")'
                       href="<?php echo add_query_arg( [
						   'action' => "delete",
						   'row_id' => $file->id
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