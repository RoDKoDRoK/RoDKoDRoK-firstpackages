<?php

class UserRoduser
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
		if($login!="" && $pwd!="")
		{
			$result=$this->db->query_one_result("select * from user where (login_mail='".$login."' or pseudo='".$login."') and pwd='".md5($pwd)."'");
			if($result)
			{
				return $result;
			}
		}
		
		return null;
	}
	
	
	function getUser($iduser="0")
	{
		//test si iduser id numeric ou login texte
		if(!is_numeric($iduser))
			$result=$this->db->query_one_result("select * from user where (login_mail='".$iduser."' or pseudo='".$iduser."')");
		else
			$result=$this->db->query_one_result("select * from user where iduser='".$iduser."'");
		
		if($result)
		{
			$result['uid']=$result['iduser'];
			
			return $result;
		}
		
		return null;
	}
	
	
}

?>