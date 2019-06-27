<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var \app\models\ResetPasswordRequest $model */

$this->title                   = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-md-5">
			<?php $form = ActiveForm::begin(['id' => 'reset-password-request-form']); ?>
			<?= $form->field($model, 'email')->textInput(['autofocus' => TRUE]) ?>
            <div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'Send'),
					['class' => 'btn btn-primary']) ?>
				<?= Html::a('Cancel', Url::home(), ['class' => 'btn btn-default']) ?>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
