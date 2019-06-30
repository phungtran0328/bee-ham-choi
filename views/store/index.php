<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Stores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Store'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?php Pjax::begin(); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			'address',
			['class'   => 'yii\grid\ActionColumn',
			 'header'  => 'Actions',
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
			],
		],
	]); ?>

	<?php Pjax::end(); ?>

</div>
