<?php

class TokenNotoken
{
	var $conf;
	var $db;
	
	var $uid="0";
	
	var $token="manualtoken123456789";
	
	function __construct($conf,$db=null)
	{
		$this->conf=$conf;
		$this->db=$db;
		
	}
	
	
	
	
	function getUserToken($login,$pwd,$typetoken="ws")
	{
		return $this->token;
	}
	
	
	
	
	function checkUserToken($token,$uid,$typetoken="ws")
	{
		if($token==$this->token && $typetoken!="")
			return true;
		
		return null;
	}
	
}

?>