<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'guest_name')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'guest_email')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'subject')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'content')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'updated_at')->textInput() ?>

	<?= $form->field($model, 'created_at')->textInput() ?>

	<?= $form->field($model, 'reply_by')->textInput() ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
