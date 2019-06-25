<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Bookings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],

			'bill_id',
			'user_name',
			'food_name',
			'remark',
			'created_at:datetime',

			['class'   => 'yii\grid\ActionColumn',
			 'buttons' => [
				 'view'   => function ($url, $model){
					 return Html::a(Html::tag('i', '',
						 ['class' => 'fas fa-eye fa-fw text-muted']),
						 $url);
				 },
				 'update' => function ($url, $model){
					 return Html::a(Html::tag('i', '',
						 ['class' => 'fas fa-cog fa-fw text-muted']),
						 $url);
				 },
				 'delete' => function ($url, $model){
					 return Html::a(Html::tag('i', '',
						 ['class' => 'fas fa-times fa-fw text-muted']), $url,
						 [
							 'data-confirm' => 'Delete',
							 'data-method'  => 'post',
						 ]);
				 },
			 ],
			 'options' => ['class' => 'actioncolumn'],
			],
		],
	]); ?>


</div>
