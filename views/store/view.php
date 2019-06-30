<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Store */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-view">

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
			'name',
			'address',
			[
				'attribute' => 'created_by',
				'value'     => function ($data){
					/** @var \app\models\Store $data */
					if ($data->updated_by === 1){
						return 'admin';
					}

					return 'Eo phai admin';
				}
			],
			'updated_by',
			'created_at:datetime',
			'updated_at:datetime',
		],
	]) ?>

</div>
