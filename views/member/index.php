<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Member'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'name',
			[
				'label' => 'Gender',
				'value' => function ($model){
					if ($model->gender == \app\models\Member::GENDER_FEMALE){
						return 'Female';
					}

					return 'Male';
				}
			],
			'birthday',
			'description',
			//'status',
			//'token',
			//'created_by',
			//'created_at',
			//'updated_by',
			//'updated_at',

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
