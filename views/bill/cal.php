<?php

/* @var $this \yii\web\View */

use yii\helpers\Html;

/* @var $bookings \app\models\Booking[] */
?>
<div class="container">
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
                <td><?= Html::encode($bk->food_name) ?></td>
                <td><?= Html::encode($bk->remark) ?> </td>
            </tr>
			<?php $count ++; ?><?php endforeach; ?>
        </tbody>
    </table>
</div>
