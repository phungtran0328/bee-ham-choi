<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/** @var app\models\ChangePassForm $model */
/* @var $this \yii\web\View */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profile'), 'url' => ['profile/index']];
$this->title                   = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-change-password">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to change password:</p>

    <div class="row">
        <div class="col-lg-5">
	        <?php $form = ActiveForm::begin([
		        'id'                     => 'change_password_form',
		        'enableAjaxValidation'   => TRUE,
		        'enableClientValidation' => TRUE,
	        ]); ?>
			<?= $form->field($model, 'old_password')->passwordInput() ?>
			<?= $form->field($model, 'new_password')->passwordInput() ?>
			<?= $form->field($model, 'confirm_password')->passwordInput() ?>
            <div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'Change'),
					['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
				<?= Html::a('Cancel', ['profile/index'], ['class' => 'btn btn-default']) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

