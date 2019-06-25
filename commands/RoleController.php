<?php


namespace app\commands;


use app\models\Role;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class RoleController
 *
 * @package app\commands
 */
class RoleController extends Controller{

	/**
	 * @return int
	 */
	public function actionIndex(){
		echo "role/init [role name here]";

		return ExitCode::OK;
	}

	/**
	 * @param $name
	 *
	 * @return int
	 */
	public function actionInit($name){
		if (Role::findOne(['name' => $name, 'status' => 10])){
			echo "Exist";

			return ExitCode::UNAVAILABLE;
		}
		$model = new Role([
			'name' => $name,
		]);

		if ($model->save()){
			echo "Successful";

			return ExitCode::OK;
		}
		if ($errors = $model->errors){
			foreach ($errors as $error){
				var_dump($error);
			}

			return ExitCode::UNAVAILABLE;
		}
		echo "UNAVAILABLE 500";

		return ExitCode::UNAVAILABLE;
	}

	/**
	 * @param $name
	 *
	 * @return int
	 */
	public function actionDelete($name){
		$role = Role::findOne(['name' => $name, 'status' => 10]);
		if ($role !== NULL){
			if ($role->softDelete()){
				echo "Successful";

				return ExitCode::OK;
			}
		}
		echo "Not Exist";

		return ExitCode::UNAVAILABLE;
	}
}