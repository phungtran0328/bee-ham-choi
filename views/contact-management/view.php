<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */

$this->title                   = 'Contact View';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view">

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
			'guest_name',
			'guest_email:email',
			'subject',
			'content',
			'status',
			'updated_at',
			'created_at',
			'reply_by',
		],
	]) ?>

</div>
