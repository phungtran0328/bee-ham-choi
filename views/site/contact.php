<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\ContactForm */

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title                   = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="alert alert-success">
        Không yêu đừng nói lời cay đắng.
    </div>

	<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

	<?php else: ?>

        <div class="row">
            <div class="col-lg-8">

	            <?php $form = ActiveForm::begin([
		            'id'     => 'contact-form',
		            'layout' => ActiveForm::LAYOUT_HORIZONTAL,
	            ]); ?>

	            <?= $form->field($model, 'guest_name')->textInput(['autofocus' => TRUE]) ?>

	            <?= $form->field($model, 'guest_email') ?>

				<?= $form->field($model, 'subject') ?>

	            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

	            <?= $form->field($model, 'verifyCode')->widget(ReCaptcha2::class) ?>

                <div class="form-group">
					<?= Html::submitButton('Submit',
						['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

				<?php ActiveForm::end(); ?>

            </div>
        </div>

	<?php endif; ?>
</div>
