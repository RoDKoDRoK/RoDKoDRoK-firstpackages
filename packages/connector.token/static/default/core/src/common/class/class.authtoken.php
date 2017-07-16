<?php

class AuthToken
{
	var $instanceUser;
	var $instanceUsertoken;
	
	var $argv=null;
	
	
	function __construct($instanceUsertoken,$instanceUser)
	{
		$this->instanceUserToken=$instanceUsertoken;
		$this->instanceUser=$instanceUser;
	}
	
	
	function authtoken_connexion($typetoken="ws")
	{
		//cas ws
		if($typetoken=="ws")
		{
			if(isset($_POST['token']) && $_POST['token']!="" && isset($_POST['uid']) && $_POST['uid']!="")
			{
				$result=$this->instanceUsertoken->checkUserToken($_POST['token'],$_POST['uid'],$typetoken);
				if($result)
				{
					$this->instanceUser->uid=$result['iduser'];
					
					//rearrange result db
					$result['uid']=$result['iduser'];
					
					return $result;
				}
				
			}
		}
		
		
		
		//cas terminal ou cron via web
		if($typetoken=="terminal" || $typetoken=="cron")
		{
			if(isset($_GET['token']) && $_GET['token']!="" && isset($_GET['uid']) && $_GET['uid']!="")
			{
				$result=$this->instanceUsertoken->checkUserToken($_GET['token'],$_GET['uid'],$typetoken);
				if($result)
				{
					$this->instanceUser->uid=$result['iduser'];
					
					//rearrange result db
					$result['uid']=$result['iduser'];
					
					return $result;
				}
				
			}
		}
		
		
		
		//cas terminal ou cron via console
		if($typetoken=="terminal" || $typetoken=="cron")
		{
			if(isset($this->argv[1]) && $this->argv[1]!="" && isset($this->argv[2]) && $this->argv[2]!="")
			{
				$result=$this->instanceUsertoken->checkUserToken($this->argv[1],$this->argv[2],$typetoken);
				if($result)
				{
					$this->instanceUser->uid=$result['iduser'];
					
					//rearrange result db
					$result['uid']=$result['iduser'];
					
					return $result;
				}
				
			}
		}
		
		
		
		
		$this->instanceUser->uid="none";
		
		return null;
	}


}

?>