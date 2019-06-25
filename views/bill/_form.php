<?php

use app\models\Bill;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'is_finished')->dropDownList([
		Bill::NOT_FINISHED => 'NOT FINISHED',
		Bill::FINISHED     => 'FINISHED'
	]) ?>

	<?= $form->field($model, 'token')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'created_by')->textInput() ?>

	<?= $form->field($model, 'updated_by')->textInput() ?>

	<?= $form->field($model, 'created_at')->textInput() ?>

	<?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
