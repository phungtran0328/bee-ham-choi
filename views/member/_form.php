<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $form yii\widgets\ActiveForm */
AppAsset::register($this);

?>

<div class="member-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'gender')
	         ->dropDownList($model::gender(), ['prompt' => 'Select Gender']); ?>


	<?= $form->field($model, 'birthday')->textInput() ?>

	<?= $form->field($model, 'description')->textInput(['maxlength' => TRUE]) ?>

	<?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
