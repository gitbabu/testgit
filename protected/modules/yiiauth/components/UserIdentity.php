<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/*ERROR_NONE=0;
	ERROR_USERNAME_INVALID = 1;
	ERROR_PASSWORD_INVALID = 2;
	ERROR_UNKNOWN_IDENTITY = 100;
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function hybridauth($username)
	{
		$user=User::model()->find("Fname = '" . firstname . "'");
		if ( $user === null ) 
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else
		{
			$this->_id = $user->UserID;
			$this->firstname = $user->Fname;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}
	
	public function authenticate()
	{
		$user=User::model()->find("Fname = '" . $this->firstname . "'");
		if ( $user === null ) 
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		
		else if ( !$user->validatePassword ( $this->password , $user->Password ))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		
		else
		{
			$this->_id = $user->UserID;
			$this->firstname = $user->Fname;
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}
	public function authenticate2($facebook_id)
	{
		$user=User::model()->findByAttributes(array('SocialNetwordID'=>$facebook_id));
		if($user===null){
		$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}