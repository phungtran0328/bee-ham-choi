<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\helper\SocialMediaTags;
use app\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
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
	<?php
	$this->registerCsrfMetaTags();
	SocialMediaTags::generateFacebook([
		'og:site_name'    => Yii::$app->name,
		'og:title'        => $this->title,
		'og:description'  => $this->params['description'] ?? 'Welcome bee ham chơi !',
		'og:image'        => Yii::$app->urlManager->createAbsoluteUrl([$this->params['link_img'] ?? '/images/beehamchoi.jpg']),
		'og:url'          => Yii::$app->urlManager->createAbsoluteUrl([Yii::$app->request->url]),
		'og:type'         => "website",
		'og:image:width'  => "450",
		'og:image:height' => "450",
	]);
	SocialMediaTags::generateTwitter([
		'twitter:card' => 'summary_large_image'
	]);
	?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="icon" href="<?= Url::to(['/images/favicon.ico']) ?>" type="image/gif" sizes="16x16">
</head>
<body>

<?php $this->beginBody() ?>

<div class="container">
    <noscript><h1 class="text-danger">Mở JavaScript lên đi. Tiền bối đừng phá tiểu đệ nữa.</h1>
    </noscript>
	<?php
	if (Yii::$app->user->can('admin')){
		$item['management'] = ['label'           => 'Management',
		                       'encode'          => FALSE,
		                       'dropdownOptions' => ['class' => 'dropdown-menu dropdown-menu-right'],
		                       'items'           => [
			                       ['label'  => 'Contact',
			                        'url'    => Url::toRoute(['contact-management/index']),
			                        'encode' => FALSE],
			                       ['label'  => 'Store',
			                        'url'    => Url::toRoute(['store/index']),
			                        'encode' => FALSE],
		                       ]];
	}
	$item['about']   = ['label' => 'About', 'url' => ['/site/about']];
	$item['contact'] = ['label' => 'Contact', 'url' => ['/site/contact']];
	if (Yii::$app->user->can('admin')){
		$item['bill'] = ['label' => 'Bills', 'url' => ['/bill/index']];
	}
	$item['islogin'] = ['label' => 'Login', 'url' => ['/site/login']];
	if (!Yii::$app->user->isGuest){
		$item['islogin'] = ['label'           => Yii::$app->user->identity->username,
		                    'encode'          => FALSE,
		                    'dropdownOptions' => ['class' => 'dropdown-menu dropdown-menu-right'],
		                    'items'           => [
			                    ['label'  => '<i class="fa fa-user"></i> My Profile',
			                     'url'    => Url::toRoute(['/profile']),
			                     'encode' => FALSE],
			                    ['label'  => '<i class="fa fa-user-secret"></i> Change password',
			                     'url'    => Url::toRoute(['/profile/change-password']),
			                     'encode' => FALSE],
			                    ['label'       => '<i class="fa fa-sign-out-alt"></i> Logout',
			                     'url'         => ['/site/logout'],
			                     'encode'      => FALSE,
			                     'linkOptions' => ['data-method' => 'post']],
		                    ]];
	}
	?>
    <nav class="navbar navbar-expand-md navbar-light pr-0 pl-0">
		<?= Html::a(Yii::$app->name, Url::home(), [
			'class' => 'navbar-brand logo-beehamchoi'
		]) ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
			<?= Nav::widget([
				'options' => ['class' => 'navbar-nav ml-auto'],
				'items'   => $item,
			]); ?>
        </div>
    </nav>
	<?= Breadcrumbs::widget([
		'links'              => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		'itemTemplate'       => "<li class='breadcrumb-item'>{link}</li>\n",
		'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
	]) ?>

	<?= Alert::widget() ?>

	<?= $content ?>

</div>
<button id="footerBtn" type="button" class="footer-btn-tool btn btn-light">
    <i class="fas fa-chevron-right m-auto rotate-reset"></i></button>
<div id="footerContent" class="footer-content" role="alert">
    <div class="d-flex h-100">
        <span class="m-auto">&copy; bee ham chơi</span>
    </div>
</div>
<?php $this->endBody() ?>
<?php
$js = <<<JS
$('#footerBtn').click(function() {
    $('#footerContent').animate({
      width: "toggle",
    },{
        duration: 400,
    });
    $('.fa-chevron-right').toggleClass('rotate');
    $('.fa-chevron-right').toggleClass('rotate-reset');
});
JS;
$this->registerJs($js, View::POS_READY)
?>
</body>
</html>
<?php $this->endPage() ?>
