<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'gender')->textInput() ?>

	<?= $form->field($model, 'birthday')->textInput() ?>

	<?= $form->field($model, 'description')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
