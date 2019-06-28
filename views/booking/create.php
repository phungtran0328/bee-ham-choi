<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */
/* @var $bill \app\models\Bill|null */

$this->title                   = Yii::t('app', 'Đặt Món');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bookings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['link_img']      = '/images/food.jpg';
?>
    <div class="booking-create">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-6">
				<?= $this->render('_form', [
					'model' => $model,
					'bill'  => $bill,
				]) ?>
            </div>
            <div class="col-6">
				<?= $this->render('/bill/cal', ['bookings' => $bill->bookings]) ?>
            </div>
        </div>
    </div>
<?php
$js = <<<JS
$('select').select2({
placeholder: 'Select your name',
theme: 'bootstrap4',
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>