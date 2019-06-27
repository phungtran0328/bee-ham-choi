<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var app\models\User $model */
?>

<?php $form = ActiveForm::begin([
	'id'            => 'user_form',
	'validationUrl' => ['validate', 'id' => $model->id],
	'layout'        => 'horizontal',
	'fieldConfig'   => [
		'horizontalCssClasses' => [
			'label'   => 'col-sm-4',
			'offset'  => 'col-sm-offset-4',
			'wrapper' => 'col-sm-8'
		],
	],
]); ?>

<?= $form->field($model, 'password', ['horizontalCssClasses' => [
	'label'   => 'col-sm-2',
	'offset'  => 'col-sm-offset-2',
	'wrapper' => 'col-sm-6']])->passwordInput() ?>

<?= Html::submitButton('Confirm',
	['class' => 'btn btn-primary', 'name' => 'confirm-btn']) ?>
<?= Html::a('Cancel', ['profile/index'], ['class' => 'btn btn-default']) ?>
<?php ActiveForm::end(); ?>
