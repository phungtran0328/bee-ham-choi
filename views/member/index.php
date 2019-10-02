<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
			'gender',
			'birthday',
			'description',
			//'status',
			//'token',
			//'created_by',
			//'created_at',
			//'updated_by',
			//'updated_at',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>


</div>
