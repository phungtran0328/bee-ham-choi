<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Confession */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="confession-form col-6">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'content')->textarea(['maxlength' => TRUE, 'rows' => 8,]) ?>

    <div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Đăng bài viết'), ['class' => 'btn btn-success']) ?>
		<?= Html::a('Cancel', Url::home(), ['class' => 'btn btn-default']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
