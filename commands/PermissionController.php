<?php


namespace app\commands;

use app\models\Permission;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * Class RoleController
 *
 * @package app\commands
 */
class PermissionController extends Controller{

	/**
	 * @return int
	 */
	public function actionIndex(){
		echo "permission/init";

		return ExitCode::OK;
	}

	/**
	 *
	 */
	public function actionInit(){
		$permissions     = Yii::$app->params['permission'];
		$count           = 0;
		$permission_data = [];
		foreach ($permissions as $permission){
			$model = Permission::findOne(['name' => $permission]);
			if (!$model){
				$model = new Permission([
					'name' => $permission,
				]);
				$count ++;
			}
			$model->synced = 1;
			if ($model->save()){
				$permission_data[] = $permission;
			}
		}
		if ($permission_data){
			$old_permissions = Permission::find()
			                             ->andWhere(['synced' => 0])
			                             ->indexBy('id')
			                             ->asArray()
			                             ->all();
			if (!empty($old_permissions)){
				$old_permissions = array_keys($old_permissions);
				Permission::deleteAll(['id' => $old_permissions]);
			}
		}
		Permission::updateAll(['synced' => 0]);
		echo "Add successful $count";

		return ExitCode::OK;
	}
}