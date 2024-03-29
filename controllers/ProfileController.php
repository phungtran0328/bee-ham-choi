<?php

namespace app\controllers;

use app\models\ChangePassForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
			if (Yii::$app->request->isAjax && $model->load($post)){
				Yii::$app->response->format = Response::FORMAT_JSON;

				return ActiveForm::validate($model);
			}
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

			return $this->goHome();
		}

		if (empty(Yii::$app->session['update'])){
			return $this->goHome();
		}

		$model    = User::findByUsername(Yii::$app->user->identity->username);
		$password = Yii::$app->request->post('User')['password'];

		if (!empty($password) && $model->validatePassword($password)){
			if ($model->load(Yii::$app->session['update']) && $model->save()){
				Yii::$app->session->remove('update');
				Yii::$app->session->setFlash('success', 'Profile successfully updated.');

				return $this->redirect(['profile/index']);
			}
			if ($errors = $model->errors){
				foreach ($errors as $error){
					Yii::$app->session->setFlash('error', $error);
				}

				return $this->redirect(['profile/index']);
			}
		}

		return $this->render('confirm', [
			'model' => $model,
		]);
	}

	/**
	 * @return string|\yii\web\Response
	 * @throws \yii\base\Exception
	 */
	public function actionChangePassword(){
		$user         = Yii::$app->user;
		$mail         = $user->identity->email;
		$support_mail = Yii::$app->params['supportEmail'];
		$model        = new ChangePassForm();
		$post         = Yii::$app->request->post();

		if ($model->load($post)){
			if (!Yii::$app->request->isAjax){
				if ($model->change()){
					return $this->redirect(['profile/index']);
				}
			}
			Yii::$app->response->format = Response::FORMAT_JSON;

			return ActiveForm::validate($model);
		}

		return $this->render('change-password', [
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