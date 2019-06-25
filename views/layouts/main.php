<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="icon" href="<?= Url::to(['/images/favicon.ico']) ?>?>" type="image/gif" sizes="16x16">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container">
			<?= Html::a(Yii::$app->name, Url::home(), [
				'class' => 'navbar-brand logo-beehamchoi'
			]) ?>
			<?= Nav::widget([
				'items' => [
					['label' => 'About', 'url' => ['/site/about']],
					['label' => 'Contact', 'url' => ['/site/contact']],
					Yii::$app->user->isGuest ?
						Html::tag('li', Html::a('Login', ['site/login'],
							['class' => 'nav-link']), ['class' => 'nav-item'])
						: Html::tag('li', Html::a(
						'Logout (' . Yii::$app->user->identity->username . ')',
						['site/logout'],
						['class'       => 'nav-link',
						 'data-method' => 'post',]),
						['class' => 'nav-item']),
					Yii::$app->user->isGuest ?
						'' : Html::tag('li', Html::a(
						'Bills',
						['bill/index'],
						['class' => 'nav-link']),
						['class' => 'nav-item'])
				]]); ?>
        </div>
    </nav>
    <div class="container pt-3">
		<?= Breadcrumbs::widget([
			'links'              => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			'itemTemplate'       => "<li class='breadcrumb-item'>{link}</li>\n",
			'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="text-center">&copy; bee ham chơi <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
