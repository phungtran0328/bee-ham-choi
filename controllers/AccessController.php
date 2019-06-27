<?php

namespace app\controllers;

use yii\filters\AccessControl;

/**
 * Class AccessController
 *
 * @package app\controllers
 */
class AccessController extends \yii\web\Controller{

	/**
	 * @return array
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow'      => TRUE,
						//						'roles'      => ['admin'],
						'roleParams' => function ($rule){
							return FALSE;
						},
					],
				],
			],
		];
	}

	/**
	 * @return string
	 */
	public function actionIndex(){
		return $this->render('index');
	}

}
