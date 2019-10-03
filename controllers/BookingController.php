<?php

namespace app\controllers;

use app\models\Bill;
use app\models\Booking;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller{

	/**
	 * {@inheritdoc}
	 */
	public function behaviors(){
		return [
			'verbs'  => [
				'class'   => VerbFilter::class,
				'actions' => [
					'delete' => ['POST'],
				],
			],
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'actions' => ['create'],
						'allow'   => TRUE,
						'roles'   => ['?'],
					],
					[
						'allow' => TRUE,
						'roles' => ['@'],
					],
				],
			],
		];
	}

	/**
	 * Lists all Booking models.
	 *
	 * @return mixed
	 */
	public function actionIndex(){
		$dataProvider = new ActiveDataProvider([
			'query' => Booking::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Booking model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id){
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * @param $token
	 *
	 * @return string|\yii\web\Response
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionCreate($token){
		$model = new Booking();
		$bill  = (new Bill())->findByToken($token);

		if ($bill){
			if ($model->load(Yii::$app->request->post()) && $model->save()){
				Yii::$app->session->setFlash('success', 'Đặt món thành công.');

				return $this->redirect(['booking/create', 'token' => $token]);
			}

			return $this->render('create', [
				'model' => $model,
				'bill'  => $bill
			]);
		}
		throw new NotFoundHttpException('Đã chốt deal rồi nha bạn hiền!');
	}

	/**
	 * Updates an existing Booking model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id){
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * @param $id
	 *
	 * @return \yii\web\Response
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionDelete($id){
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * @param $id
	 *
	 * @return \app\models\Booking|null
	 * @throws \yii\web\NotFoundHttpException
	 */
	protected function findModel($id){
		if (($model = Booking::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}
