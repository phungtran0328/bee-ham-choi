<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\User $model */
/* @var $this \yii\web\View */

?>

<?php $form = ActiveForm::begin([
	'id'                   => 'user_form',
	'layout'               => 'horizontal',
	'enableAjaxValidation' => TRUE,
	'fieldConfig'          => [
		'horizontalCssClasses' => [
			'label'   => 'col-sm-4',
			'offset'  => 'col-sm-offset-4',
			'wrapper' => 'col-sm-8'
		],
	],
]); ?>

<?= $form->field($model, 'username', ['horizontalCssClasses' => [
	'label'   => 'col-sm-2',
	'offset'  => 'col-sm-offset-2',
	'wrapper' => 'col-sm-6']])->textInput(['disabled' => 'disabled']) ?>

<?= $form->field($model, 'name', ['horizontalCssClasses' => [
	'label'   => 'col-sm-2',
	'offset'  => 'col-sm-offset-2',
	'wrapper' => 'col-sm-6']]) ?>

<?= $form->field($model, 'email', ['horizontalCssClasses' => [
	'label'   => 'col-sm-2',
	'offset'  => 'col-sm-offset-2',
	'wrapper' => 'col-sm-6']]) ?>

<?= $form->field($model, 'phone_number', ['horizontalCssClasses' => [
	'label'   => 'col-sm-2',
	'offset'  => 'col-sm-offset-2',
	'wrapper' => 'col-sm-6']]) ?>

<div class="form-group">
	<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
	<?= Html::a('Cancel', Url::home(), ['class' => 'btn btn-default']) ?>
</div>

<?php ActiveForm::end(); ?>
