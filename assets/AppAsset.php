<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle{

	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/select2.min.css',
		'css/select2-bootstrap4.min.css',
		'css/main.css',
	];
	public $js = [
		'js/select2.min.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap4\BootstrapAsset',
		'yii\bootstrap4\BootstrapPluginAsset'
	];
}
