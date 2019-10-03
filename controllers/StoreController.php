<?php

namespace app\controllers;

use app\models\Store;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller{

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
						'allow' => TRUE,
						'roles' => ['admin'],
					],
				],
			],
		];
	}

	/**
	 * Lists all Store models.
	 *
	 * @return mixed
	 */
	public function actionIndex(){
		$dataProvider = new ActiveDataProvider([
			'query' => Store::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Store model.
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
	 * Creates a new Store model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate(){
		$model = new Store();

		if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * @param $id
	 *
	 * @return string|\yii\web\Response
	 * @throws \yii\web\NotFoundHttpException
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
	 * @return \app\models\Store|null
	 * @throws \yii\web\NotFoundHttpException
	 */
	protected function findModel($id){
		if (($model = Store::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}
