<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="row">
        <div class="col"><?php
			if (!Yii::$app->user->isGuest){
				echo "Dang nhap thanh cong";
			}
			?></div>
        <div class="col"><?php
			if (!Yii::$app->user->isGuest){
				echo "Dang nhap thanh cong";
			}
			?></div>
    </div>
</div>
