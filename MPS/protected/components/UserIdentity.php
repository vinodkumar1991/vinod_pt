<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		*/
		$users = MPSUSER::model()->findByAttributes(array('user'=>$this->id));
		//if(!isset($users[$this->username]))

		    //if(!isset($users->user))
		    if(count($users)<=0)
		    {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
		    }elseif ($users->password!=$this->password) {
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
		    }else{
                Yii::app()->user->setState('user', $users->user);
                Yii::app()->user->setState('role', $users->role_id);
				$this->errorCode=self::ERROR_NONE;
		    }

		return !$this->errorCode;
	}
	

 


	
	
	
}
