<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

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
				'token',
				'created_at:datetime',
				'updated_at:datetime',
				[
					'format' => 'raw',
					'label'  => 'Thống kê',
					'value'  => function ($data){
						$html = Html::a(Html::tag('i', '',
							['class' => 'fas fa-calculator fa-fw text-muted']),
							['bill/cal', 'id' => $data->id]);
						$html .= Html::a(Html::tag('i', '',
							['class' => 'fas fa-link fa-fw text-muted']),
							['booking/create', 'token' => $data->token]);
						$html .= Html::tag('i', '',
							['class' => 'fas fa-copy fa-fw text-muted copy-link',
							 'url'   => Yii::$app->urlManager->createAbsoluteUrl(['booking/create', 'token' => $data->token])]);

						return $html;
					}
				],
				[
					'attribute' => 'is_finished',
					'content'   => function ($a){
						/** @var \app\models\Bill $a */
						$st = '';
						if ($a->is_finished === 10){
							$st = 'disabled';
						}

						return Html::dropDownList(NULL, $a->is_finished,
							[10 => 'Đã chốt', 0 => 'Chưa chốt'],
							['class'   => 'is-finished',
							 'bill_id' => $a->id,
							 $st       => TRUE
							]);
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
<?php
$url = Url::toRoute(['bill/finished']);
$js  = <<<JS
$(".is-finished").change(function(e) {
    if(confirm('Đơn hàng sau khi chốt không thể sửa. Bạn có chắc chắn chốt đơn hàng?')){
        bill_id = $(this).attr('bill_id');
        $.ajax({
        url: "{$url}",
        type: 'POST',
        data: {
            id: bill_id,
        }
      }).done(function() {
          location.reload();
      }).fail(function(data) {
          alert('Lỗi');
          location.reload();
      })
    }else {
        location.reload();
    }
});
$(".copy-link").click(function() {
  url = $(this).attr('url');
  var el = document.createElement('textarea');
  el.value = url;
  el.setAttribute('readonly', '');
  el.style = {position: 'absolute', left: '-10000px'};
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
});
JS;
$this->registerJs($js);
?>