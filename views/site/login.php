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
				<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

				<?= $form->field($model, 'username')
				         ->textInput(['autofocus' => TRUE]) ?>

				<?= $form->field($model, 'password')->passwordInput() ?>

				<?= $form->field($model, 'rememberMe', ['enableClientValidation' => FALSE])
				         ->checkbox() ?>

				<?= Html::submitButton('Login',
					['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

				<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>