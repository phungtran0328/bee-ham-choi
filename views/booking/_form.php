<?php

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */
/* @var $form yii\widgets\ActiveForm */
/* @var $bill */
?>

    <div class="booking-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'bill_id')
		         ->hiddenInput(['value' => !empty($bill->id) ? $bill->id : $model->bill_id])
		         ->label(FALSE) ?>

		<?= $form->field($model, 'user_name')
		         ->dropDownList(Yii::$app->params['staff'], [
			         'prompt' => '',
		         ]) ?>

		<?= $form->field($model, 'food_name')->textInput(['maxlength' => TRUE]) ?>

		<?= $form->field($model, 'remark')->textarea(['maxlength' => TRUE]) ?>

	    <?php
	    if ($model->isNewRecord){
		    echo $form->field($model, 'verify_code', ['enableAjaxValidation' => FALSE,])
		              ->widget(ReCaptcha2::class);
	    }
	    ?>

        <div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

		<?php ActiveForm::end(); ?>

    </div>
<?php
$js = <<<JS
$('select').select2({
placeholder:'Select your name',
theme: 'bootstrap4',
width: 'style',
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>