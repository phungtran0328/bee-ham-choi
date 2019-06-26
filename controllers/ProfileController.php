<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;

/**
 * Class ProfileController
 *
 * @package app\controllers
 */
class ProfileController extends Controller{

	/**
	 * {@inheritdoc}
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					['allow' => TRUE,
					 'roles' => ['@'],
					]
				]
			],
		];
	}

	/**
	 * @return string|\yii\web\Response
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionIndex(){
		$id    = Yii::$app->user->identity->getId();
		$model = $this->findModel($id);
		$post  = Yii::$app->request->post();
		if (!empty($post)){
			Yii::$app->session['update'] = $post;

			return $this->redirect(['profile/confirm']);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionConfirm(){
		$request = new Request(['url' => parse_url(Yii::$app->request->referrer, PHP_URL_PATH)]);
		$url     = Yii::$app->urlManager->parseRequest($request);

		if (!in_array($url[0], ['profile/index', 'profile/confirm'])){
			Yii::$app->session->remove('update');

			return $this->redirect(Url::home());
		}
		if (empty(Yii::$app->session['update'])){
			return $this->redirect(Url::home());
		}
		$model = User::findByUsername(Yii::$app->user->identity->username);
		$pass  = Yii::$app->request->post('User')['password'];
		if (!empty($pass)){
			if ($model->validatePassword($pass)){
				if ($model->load(Yii::$app->session['update']) && $model->save()){
					Yii::$app->session->remove('update');
					Yii::$app->session->setFlash('success', 'Profile successfully updated.');

					return $this->redirect(['profile/index']);
				}
			}

			Yii::$app->session->setFlash('error', 'Password is incorrect');
		}

		return $this->render('confirm', [
			'model' => $model,
		]);
	}

	/**
	 * @param $id
	 *
	 * @return \app\models\User|null
	 * @throws \yii\web\NotFoundHttpException
	 */
	protected function findModel($id){
		if (($model = User::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}