<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Contact Management');
$this->params['breadcrumbs'][] = ['label' => 'Contact',
                                  'url'   => Url::toRoute(['contact-management/index']),];
$this->params['breadcrumbs'][] = 'Management';
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'guest_name',
			'guest_email:email',
			'subject',
			'content',
			//'status',
			//'updated_at',
			//'created_at',
			//'reply_by',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>


</div>
