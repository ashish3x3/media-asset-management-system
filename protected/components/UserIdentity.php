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
	
	private $_id;
	private $_uid;
	public function authenticate()
	{
		
	/*
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->err orCode;
	*/
		
		$record=Users::model()->findByAttributes(array('name'=>$this->username));
		if($record===null)
		$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if ($record->password!==crypt($this->password,'salt'))
		$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
	    $this->_id=$record->orgId;
	    $this->_uid=$record->uid;
	    //setting the session variable uid with id of the logged in user
	    $this->setState('uid', $record->uid,NULL);
	    //Yii::app()->user->setState("uid","value");
		$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
		
	}
	
	public function getId()
	{
		return $this->_id;
	}
	public function getUid(){
		return $this->_uid;
	}

	
}