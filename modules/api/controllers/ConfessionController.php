<?php

namespace app\modules\api\controllers;

use app\models\Confession;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class ConfessionController
 *
 * @package app\modules\api\controllers
 */
class ConfessionController extends Controller{

	/**
	 * @return array
	 */
	public function behaviors(){
		return [
			'access' => [
				'class' => AccessControl::class,
				'rules' => [
					[
						'allow' => TRUE,
					],
				],
			],
		];
	}

	/**
	 * @return string
	 * @throws \yii\web\HttpException
	 */
	public function actionIndex(){
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
		$html   = $this->renderAjax('index', ['query' => $query,]);

		Yii::$app->response->format = Response::FORMAT_JSON;

		return ['code'    => 200,
		        'content' => $html,];
	}

	/**
	 * @return string
	 */
	public function actionList(){

		$page = Yii::$app->request->get('page') ?? 1;

		if ($page == 'all'){
			return $this->render('list-all',
				['query' => Confession::find()->orderBy(['created_at' => SORT_DESC])->all(),]);
		}

		$limit  = 4;
		$offset = $limit * ($page - 1);
		$query  = Confession::find()
		                    ->orderBy(['created_at' => SORT_DESC])
		                    ->limit($limit)
		                    ->offset($offset);

		$total_page = ceil(($query->count()) / $limit);

		return $this->render('list', [
			'query'        => $query->all(),
			'total'        => $total_page,
			'current_page' => $page]);
	}
}
