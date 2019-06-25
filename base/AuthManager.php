<?php


namespace app\base;


use yii\base\Component;

/**
 * Class AuthManager
 *
 * @package app\base
 */
class AuthManager extends Component{

	/**
	 * @param $user_id
	 * @param $permission_name
	 * @param array $params
	 *
	 * @return bool
	 */
	public function checkAccess($user_id, $permissions, $parrams = []){
		if (\Yii::$app->user->isGuest){
			return FALSE;
		}
		if (\Yii::$app->user->identity->getId() == 1){
			var_dump($permissions);

			return TRUE;
		}

		return FALSE;
	}
}