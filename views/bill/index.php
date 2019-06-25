<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Bills');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a(Yii::t('app', 'Create Bill'),
			['create'], ['class'       => 'btn btn-success',
			             'data-method' => 'post']) ?>
    </p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns'      => [['class' => 'yii\grid\SerialColumn'],
			'id',
			'is_finished',
			'token',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'format' => 'raw',
				'label'  => 'Thống kê',
				'value'  => function ($data){
					$html = Html::a(Html::tag('i', '',
						['class' => 'fas fa-calculator text-muted']),
						['bill/cal', 'id' => $data->id]);
					$html .= Html::a(Html::tag('i', '',
						['class' => 'fas fa-link text-muted']),
						['booking/create', 'token' => $data->token]);

					return $html;
				}
			],
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
			],],]);
	?>

</div>
