<?php

/* @var $query \app\models\Confession[] */

/* @var $this \yii\web\View */

/* @var $total float */

/* @var $current_page array|int|mixed */

use yii\helpers\Html;

foreach ($query as $key => $cf): ?>
    <div class="alert alert-<?= ($key % 2 == 0) ? 'warning' : 'success' ?> d-flex">
        <div class="col-9">
			<?= Html::encode($cf->content); ?>
        </div>
        <div class="col-3">
            <h4>#<?= $cf->id; ?></h4>
        </div>
    </div>
<?php endforeach; ?>
<?php
if ($current_page > 1 && $total > 1){
	echo Html::a('Prev', ['confession/list', 'page' => ($current_page - 1)]) . ' ';
}
for ($i = 1; $i <= $total; $i ++){
	echo Html::a($i, ['confession/list', 'page' => $i],
			['class' => ($current_page == $i) ? 'text-warning bg-primary' : '',]) . ' ';
}
if ($current_page < $total && $total > 1){
	echo Html::a('Next', ['confession/list', 'page' => ($current_page + 1)]);
}
echo Html::a('All', ['confession/list', 'page' => 'all'], ['class' => 'ml-5']);
?>
