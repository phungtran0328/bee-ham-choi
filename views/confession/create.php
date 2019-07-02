<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Confession */

$this->title                   = Yii::t('app', 'Bee ham chơi Confession');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confession-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
