<?php


namespace app\controllers;


use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller{

	/**
	 * {@inheritdoc}
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::class,
				'only'  => ['profile'],
				'rules' => [
					[
						'actions' => ['profile'],
						'allow'   => TRUE,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::class,
				'actions' => [
					'profile' => ['post'],
				],
			],
		];
	}

	public function actionIndex(){
		$id                          = Yii::$app->user->identity->getId();
		$model                       = $this->findModel($id);
		Yii::$app->session['update'] = Yii::$app->request->post();
		if (!empty(Yii::$app->session['update'])){
			return $this->redirect(['profile/confirm']);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	public function actionConfirm(){
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

					return $this->redirect(['profile/update', 'id' => $model->id]);
				}
			}

			Yii::$app->session->setFlash('error', 'Password is incorrect');
		}


		return $this->render('confirm', [
			'model' => $model,
		]);
		throw new NotFoundHttpException("Username không hợp lệ nha bạn !");
	}

	/**
	 * Finds the Booking model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if (($model = User::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}