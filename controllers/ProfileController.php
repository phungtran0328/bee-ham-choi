<?php

namespace app\controllers;

use app\helper\MailHelper;
use app\models\ChangePassForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
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
	 * @return string|\yii\web\Response
	 * @throws \yii\base\Exception
	 */
	public function actionChangePassword(){
		$user  = Yii::$app->user;
		$mail  = $user->identity->email;
		$model = new ChangePassForm();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->change()){
			Yii::$app->session->setFlash('success', 'Change password is success');
			$send_mail = new MailHelper();
			$send_mail->sendMail('changePassword-html', $user->identity,
				$mail, 'Change password for beehamchoi.com');

			return $this->redirect(['profile/index']);
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

	public function actionValidate(){
		$model = new ChangePassForm();
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = Response::FORMAT_JSON;

			return ActiveForm::validate($model);
		}

		return [];
	}
}