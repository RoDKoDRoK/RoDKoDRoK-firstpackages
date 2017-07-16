<?php

class UserNouser
{
	var $conf;
	var $db;
	
	var $uid="0";
	
	function __construct($conf,$db=null)
	{
		$this->conf=$conf;
		$this->db=$db;
		
	}
	
	
	function checkUserLogin($login,$pwd)
	{
		if($login!="admin" && $pwd!="admin")
		{
			$result=array();
			$result['pseudo']=$login;
			$result['login_mail']=$login;
			
			return $result;
		}
		
		return null;
	}
	
	
}

?>