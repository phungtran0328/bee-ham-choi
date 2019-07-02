<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Confessions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confession-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Confession'), ['create'],
			['class' => 'btn btn-success']) ?>
    </p>


	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'content',
			'created_at',
			'updated_at',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>


</div>
