<?php

use app\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
AppAsset::register($this);

$this->title                   = Yii::t('app', 'Create Member');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create form-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
