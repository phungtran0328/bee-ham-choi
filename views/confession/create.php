<?php

/* @var $this yii\web\View */
/* @var $model app\models\Confession */

$this->title                   = Yii::t('app', 'Confession');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confession-create">

    <h1>Confession</h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
