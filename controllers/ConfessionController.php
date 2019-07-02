<?php

namespace app\controllers;

use app\models\Confession;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\HttpException;
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
						'actions' => ['create', 'list'],
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
	 * Displays a single Confession model.
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
	 * Creates a new Confession model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
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
	 * Updates an existing Confession model.
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
	 * Finds the Confession model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Confession the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id){
		if (($model = Confession::findOne($id)) !== NULL){
			return $model;
		}

		throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
	}

	/**
	 * @return string
	 * @throws \yii\web\HttpException
	 */
	public function actionList(){
		if (!Yii::$app->request->isAjax){
			throw new HttpException(404, 'Page not found.');
		}
		$page   = Yii::$app->request->post('page');
		$limit  = Yii::$app->request->post('limit');
		$offset = $limit * ($page - 1);
		$query  = Confession::find()
		                    ->orderBy(['created_at' => SORT_DESC])
		                    ->limit($limit)
		                    ->offset($offset)
		                    ->all();
		$html   = $this->renderAjax('_index', ['query' => $query,]);

		return $html;
	}
}
