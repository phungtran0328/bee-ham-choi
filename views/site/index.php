<?php
/* @var $this yii\web\View */
/* @var $cfs static[] */
/* @var $cfs static[] */

/* @var $cfs static[] */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
    <div class="site-index">
        <div class="alert alert-success">
            <strong>Làm sao người ta có thể viết được Stackoverflow, khi chưa có Stackoverflow.</strong>
        </div>
        <div class="mb-2">
			<?= Html::a('Đăng bài viết mới', Url::toRoute(['confession/create']),
				['class' => 'btn btn-primary']) ?>
        </div>
        <div id="danhsach">
			<?php foreach ($cfs as $key => $cf): ?>
                <div class="alert alert-<?= ($key % 2 == 0) ? 'warning' : 'success' ?> d-flex">
                    <div class="col-9">
						<?= Html::encode($cf->content); ?>
                    </div>
                    <div class="col-3">
                        <h4>#<?= $cf->id; ?></h4>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
    <button id="more-btn" class="btn btn-primary mb-5">xem thêm</button>
<?php
$url = Url::toRoute(['cfs/confession/index']);
$js  = <<<JS
var page = 1;
$("#more-btn").click(function(e) {
    page = page + 1;
        $.ajax({
        url: "{$url}",
        type: 'POST',
        dataType: 'json',
        data: {
            page: page,
            limit: 6,
        }
      }).done(function(data) {
          $('#danhsach').append(data.content);
      }).fail(function(data) {
          alert('Error');
      })
});
JS;
$this->registerJs($js);
?>