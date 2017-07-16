<?php

class TokenRodtoken
{
	var $conf;
	var $db;
	
	var $uid="0";
	
	
	function __construct($conf,$db=null)
	{
		$this->conf=$conf;
		$this->db=$db;
		
	}
	
	
	
	
	function getUserToken($login,$pwd,$typetoken="ws")
	{
		if($login!="" && $pwd!="")
		{
			$result=$this->db->query_one_result("select * from user where (login_mail='".$login."' or pseudo='".$login."') and pwd='".md5($pwd)."'");
			if($result)
			{
				$newtoken=$this->generateRandomString();
				$this->db->query("update `token` set token='".$newtoken."' where iduser='".$result['iduser']."' and typetoken='".$typetoken."'");
				
				return $newtoken;
			}
		}
		
		return "";
	}
	
	
	
	
	function checkUserToken($token,$uid,$typetoken="ws")
	{
		if($token!="" && $typetoken!="")
		{
			$result=$this->db->query_one_result("select * from `token`,`user` where `token`.iduser=`user`.iduser and `token`.iduser='".$uid."' and token='".$_POST['token']."' and typetoken='".$typetoken."'");
			if($result)
			{
				return $result;
			}
		}
		
		return null;
	}
	
	
	
	
	private function generateRandomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

?>