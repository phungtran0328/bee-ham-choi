<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Contact'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


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
