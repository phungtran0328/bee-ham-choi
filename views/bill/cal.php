<?php

/* @var $this \yii\web\View */
/* @var $bookings \app\models\Booking[] */
?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Tên</th>
            <th>STT</th>
            <th>Món Ăn</th>
            <th>Ghi Chú</th>
        </tr>
        </thead>
        <tbody>
		<?php $count = 1; ?>
		<?php foreach ($bookings as $bk): ?>
            <tr>
                <td><?= $bk->user_name ?></td>
                <td><?= $count ?></td>
                <td class="break-line"><?= $bk->food_name ?></td>
                <td class="break-line"><?= $bk->remark ?> </td>
            </tr>
			<?php $count ++; ?><?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3">Tổng cộng</th>
            <th><?= count($bookings) ?></th>
        </tr>
        </tfoot>
    </table>
</div>
