<?php

/* @var $query \app\models\Confession[]|array|\yii\db\ActiveRecord[] */

/* @var $this \yii\web\View */

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