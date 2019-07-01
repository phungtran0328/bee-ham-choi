<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Signup';
?>
<div class="site-login row justify-content-center align-items-center">
    <div class="col-lg-8 col">
        <div class="card">
            <div class="card-body">
	            <?php $form = ActiveForm::begin([
		            'id'                   => 'signup-form',
		            'enableAjaxValidation' => TRUE,
		            'layout'               => ActiveForm::LAYOUT_HORIZONTAL,
		            'fieldConfig'          => [
			            'horizontalCssClasses' => [
				            'label'   => 'col-sm-3',
				            'wrapper' => 'col-sm-9'
			            ],
		            ],
	            ]); ?>

				<?= $form->field($model, 'username')
				         ->textInput(['autofocus' => TRUE]) ?>

				<?= $form->field($model, 'name')->textInput() ?>

				<?= $form->field($model, 'email')->textInput() ?>

				<?= $form->field($model, 'phone_number')->textInput() ?>

				<?= $form->field($model, 'password')->passwordInput() ?>

				<?= $form->field($model, 'password_confirm')->passwordInput() ?>

	            <?= $form->field($model, 'verify_code', ['enableAjaxValidation' => FALSE])
	                     ->widget(ReCaptcha2::class) ?>

				<?= Html::submitButton('Signup',
					['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

				<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>