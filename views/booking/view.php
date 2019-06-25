<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="booking-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id],
			['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data'  => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method'  => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model'      => $model,
		'attributes' => [
			'id',
			'bill_id',
			'user_name',
			'food_name',
			'remark',
			'created_at',
			'updated_at',
		],
	]) ?>

</div>
