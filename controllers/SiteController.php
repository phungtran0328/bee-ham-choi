<?php

namespace app\controllers;

use app\helper\MailHelper;
use app\models\Confession;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\ResetPasswordForm;
use app\models\ResetPasswordRequest;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
	 * @return array
	 */
	public function actions(){
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * @return string
	 */
	public function actionIndex(){

		$cfs = Confession::find()->orderBy(['created_at' => SORT_DESC])
		                 ->limit(6)
		                 ->offset(0)
		                 ->all();

		return $this->render('index', ['cfs' => $cfs]);
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionLogin(){
		if (!Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()){
			return $this->goBack();
		}

		return $this->render('login', [
			'model' => $model,
		]);
	}

	/**
	 * @return \yii\web\Response
	 */
	public function actionLogout(){
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionContact(){
		$model_form = new ContactForm();
		$post       = Yii::$app->request->post();
		if ($model_form->load($post) && $model_form->contactMe()){

			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		}

		return $this->render('contact', [
			'model' => $model_form,
		]);
	}

	/**
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
		if (!Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())){
			if ($user = $model->signup()){
				if (Yii::$app->user->login($user)){
					return $this->goHome();
				}
			}
		}
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = Response::FORMAT_JSON;

			return ActiveForm::validate($model);
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
		if (!Yii::$app->user->isGuest){
			return $this->goHome();
		}

		$model = new ResetPasswordRequest();
		if ($model->load(Yii::$app->request->post()) && $model->validate()){
			if ($model->sendEmail()){
				Yii::$app->session
					->setFlash('success', 'Check your email for further instructions.');

				return $this->refresh();
			}
			Yii::$app->session
				->setFlash('error',
					'Sorry, we are unable to reset password for email provided.');
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
		if (!Yii::$app->user->isGuest){
			return $this->goHome();
		}

		try{
			$model        = new ResetPasswordForm($token);
			$user         = User::findByPasswordResetToken($token);
			$support_mail = Yii::$app->params['supportEmail'];
		}catch (InvalidParamException $ex){
			throw new BadRequestHttpException($ex->getMessage());
		}

		if ($model->load(Yii::$app->getRequest()
		                          ->post()) && $model->validate() && $model->resetPassword()){
			Yii::$app->getSession()->setFlash('success', 'New password was saved.');
			MailHelper::sendEmail('changePassword-html', $user, $support_mail,
				$user->email, 'Change password for beehamchoi.com');

			return $this->redirect(['site/login']);
		}

		return $this->render('reset-password', [
			'model' => $model,
		]);
	}
}
