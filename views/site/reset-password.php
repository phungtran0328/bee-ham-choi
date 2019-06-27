<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var app\models\ResetPasswordForm $model */

$this->title                   = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-md-5">
			<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
			<?= $form->field($model, 'password')->passwordInput() ?>
			<?= $form->field($model, 'confirm_password')->passwordInput() ?>
            <div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
