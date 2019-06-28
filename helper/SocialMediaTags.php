<?php


namespace app\helper;


use Yii;

class SocialMediaTags{

	public static function generateFacebook($properties){
		foreach ($properties as $item => $value){
			Yii::$app->view->registerMetaTag([
				'property' => $item,
				'content'  => $value,
			]);
		}
	}

	public static function generateTwitter($properties){
		foreach ($properties as $item => $value){
			Yii::$app->view->registerMetaTag([
				'name'    => $item,
				'content' => $value,
			]);
		}
	}
}