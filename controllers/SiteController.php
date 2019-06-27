<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use app\models\ResetPasswordForm;
use app\models\ResetPasswordRequest;
use app\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class SiteController
 *
 * @package app\controllers
 */
class SiteController extends Controller{

	/**
	 * {@inheritdoc}
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::class,
				'only'  => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow'   => TRUE,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::class,
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions(){
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : NULL,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex(){

		return $this->render('index');
	}

	/**
	 * Login action.
	 *
	 * @return Response|string
	 */
	public function actionLogin(){
		if (!Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()){
			return $this->goBack();
		}

		$model->password = '';

		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * Logout action.
	 *
	 * @return Response
	 */
	public function actionLogout(){
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return Response|string
	 */
	public function actionContact(){
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])){
			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		}

		return $this->render('contact', [
			'model' => $model,
		]);
	}

	/**
	 * Displays about page.
	 *
	 * @return string
	 */
	public function actionAbout(){
		return $this->render('about');
	}

	/**
	 * @return string|\yii\web\Response
	 * @throws \yii\base\Exception
	 */
	public function actionSignup(){
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())){
			if ($user = $model->signup()){
				if (Yii::$app->user->login($user)){
					return $this->goHome();
				}
			}
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}

	/**
	 * @return string|\yii\web\Response
	 * @throws \yii\base\Exception
	 */
	public function actionResetPasswordRequest(){
		$model = new ResetPasswordRequest();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()){
			if ($model->sendEmail()){
				Yii::$app->getSession()
				         ->setFlash('success', 'Check your email for further instructions.');

				return $this->goHome();
			}else{
				Yii::$app->getSession()
				         ->setFlash('error',
					         'Sorry, we are unable to reset password for email provided.');
			}
		}

		return $this->render('request-token', [
			'model' => $model,
		]);
	}


	/**
	 * @param $token
	 *
	 * @return string|\yii\web\Response
	 * @throws \yii\base\Exception
	 * @throws \yii\web\BadRequestHttpException
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionResetPassword($token){
		try{
			$model = new ResetPasswordForm($token);
		}catch (InvalidParamException $ex){
			throw new BadRequestHttpException($ex->getMessage());
		}
		if ($model->load(Yii::$app->getRequest()
		                          ->post()) && $model->validate() && $model->resetPassword()){
			Yii::$app->getSession()->setFlash('success', 'New password was saved.');

			return $this->goHome();
		}

		return $this->render('reset-password', [
			'model' => $model,
		]);
	}
}
