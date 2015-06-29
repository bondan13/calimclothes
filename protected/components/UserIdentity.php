<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $hp;
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	
	public function __construct($hp,$password)
	{
		//$this->username=$username;
		$this->hp=$hp;
		$this->password=$password;
	}

	public function authenticate()
	{
        $record = User::model()->findByAttributes(array('hp'=>$this->hp));
                
		if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($record->password !== crypt($this->password, 'bondan'))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{       	
        	$this->_id=$record->id;
        	$this->setState('nama', $record->nama);
                $this->setState('level', $record->level);
        	$this->hp=$record->hp;
        	$this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
        
	}
	
	public function getId()
    {
        return $this->_id;
    }

    public function getName()
	{
		return $this->hp;
	}
}