<?php


namespace app\helper;


use Yii;
use yii\base\Component;

/**
 * Class AuthManager
 *
 * @package app\helper
 */
class AuthManager extends Component{

	/**
	 * @param $user_id
	 * @param $role
	 * @param array $params
	 *
	 * @return bool
	 */
	public function checkAccess($user_id, $role, $params = []){
		if (Yii::$app->user->isGuest){
			return FALSE;
		}

		/** @var \app\models\User $user */
		$user = Yii::$app->user->identity;

		if ($user->isAdmin()){
			return TRUE;
		}

		$user_role = $user->role->name;
		if ($user_role === $role){
			return TRUE;
		}
	}
}