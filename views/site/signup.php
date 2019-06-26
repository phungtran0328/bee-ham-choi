<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
?>
<div class="site-login row justify-content-center align-items-center">
    <div class="col-lg-4 col">
        <div class="card">
            <div class="card-body">
				<?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

				<?= $form->field($model, 'username')
				         ->textInput(['autofocus' => TRUE]) ?>

				<?= $form->field($model, 'name')->textInput() ?>

				<?= $form->field($model, 'email')->textInput() ?>

				<?= $form->field($model, 'phone_number')->textInput() ?>

				<?= $form->field($model, 'password')->passwordInput() ?>

				<?= $form->field($model, 'password_confirm')->passwordInput() ?>

				<?= Html::submitButton('Signup',
					['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

				<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>