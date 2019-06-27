<?php

namespace app\controllers;

use app\models\Bill;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BillController implements the CRUD actions for Bill model.
 */
class BillController extends Controller{

	/**
	 * {@inheritdoc}
	 */
	public function behaviors(){
		return [
			'verbs'  => [
				'class'   => VerbFilter::class,
				'actions' => [
					'delete' => ['POST'],
					'create' => ['POST'],
				],
			],
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => TRUE,
						'roles' => ['admin'],
					],
				],
			],
		];
	}

	/**
	 * Lists all Bill models.
	 *
	 * @return mixed
	 */
	public function actionIndex(){
		$dataProvider = new ActiveDataProvider([
			'query' => Bill::find()->orderBy(['created_at' => SORT_DESC]),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Bill model.
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
	 * @return string|\yii\web\Response
	 */
	public function actionCreate(){
		$model = new Bill();

		if ($model->createBill()){
			Yii::$app->session->setFlash('success', Yii::$app->urlManager->createAbsoluteUrl(
				[
					'/booking/create', 'token' => $model->token
				]
			));

			return $this->redirect(['index']);
		}
		Yii::$app->session->setFlash('error', 'Fail');

		return $this->redirect(['index']);
	}

	/**
	 * Updates an existing Bill model.
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
	 * Finds the Bill model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Bill the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if (($model = Bill::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}

	/**
	 * @param $id
	 *
	 * @return string
	 * @throws \yii\web\NotFoundHttpException
	 */
	public function actionCal($id){
		$bill     = $this->findModel($id);
		$bookings = $bill->bookings;

		return $this->render('cal', ['bookings' => $bookings]);
	}
}
