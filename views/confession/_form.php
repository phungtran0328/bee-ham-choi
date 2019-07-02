<?php

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Confession */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="confession-form col-6">

	<?php $form = ActiveForm::begin([
		'id'                     => 'confession_form',
		'enableClientValidation' => TRUE,
	]); ?>

	<?= $form->field($model, 'content')->textarea(['maxlength' => TRUE, 'rows' => 8,]) ?>

	<?= $form->field($model, 'verify_code', ['enableAjaxValidation' => FALSE])
	         ->widget(ReCaptcha2::class) ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Đăng bài viết'), ['class' => 'btn btn-success']) ?>
		<?= Html::a('Cancel', Url::home(), ['class' => 'btn btn-default']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
