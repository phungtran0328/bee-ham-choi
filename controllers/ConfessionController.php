<?php

namespace app\controllers;

use app\models\Confession;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ConfessionController implements the CRUD actions for Confession model.
 */
class ConfessionController extends Controller{

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
						'roles' => ['admin'],
					],
				],
			],
		];
	}

	/**
	 * Lists all Confession models.
	 *
	 * @return mixed
	 */
	public function actionIndex(){
		$dataProvider = new ActiveDataProvider([
			'query' => Confession::find(),
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * @param $id
	 *
	 * @return string
	 * @throws \yii\web\NotFoundHttpException
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
		$model = new Confession();

		if ($model->load(Yii::$app->request->post()) && $model->save()){
			return $this->goHome();
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
	 * @return \app\models\Confession|null
	 * @throws \yii\web\NotFoundHttpException
	 */
	protected function findModel($id){
		if (($model = Confession::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}
}
