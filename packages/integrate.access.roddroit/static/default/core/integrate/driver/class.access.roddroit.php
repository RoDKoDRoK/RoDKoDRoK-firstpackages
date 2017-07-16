<?php

class AccessRoddroit
{
	var $conf;
	var $db;
	
	var $uid="0";
	var $droit="";
	
	
	function __construct($conf,$db=null)
	{
		$this->conf=$conf;
		$this->db=$db;
		
	}
	
	function getDroitUser()
	{
		if($this->uid=="0")
		{
			$this->droit="admin";
			return "admin";
		}
		else if($this->uid!="none")
		{
			$result=$this->db->query_one_result("select * from user where iduser='".$this->uid."'");
			if($result)
			{
				$this->droit=$result['droit'];
				return $result['droit'];
			}
		}
		
		$this->droit="public";
		return $this->droit;
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
	
	
	
	function hasAccessTo($elmttoaccess,$typeelmttoaccess="page")
	{
		//droit superadmin override
		if($this->droit=="admin")
			return true;
		
		//scan des droits
		if(is_numeric($elmttoaccess))
			$req=$this->db->query("select * from `droit`,`elmt_has_droit` where `droit`.nomcodedroit=`elmt_has_droit`.nomcodedroit and typeelmt='".$typeelmttoaccess."' and idelmt='".$elmttoaccess."'");
		else
			$req=$this->db->query("select * from `droit`,`elmt_has_droit` where `droit`.nomcodedroit=`elmt_has_droit`.nomcodedroit and typeelmt='".$typeelmttoaccess."' and elmt='".$elmttoaccess."'");
		if($req)
			while($res=$this->db->fetch_array($req))
			{
				//droit correspondant
				if($this->droit==$res['nomcodedroit'])
					return true;
					
				//check droit accessible en cascade
				//get ordre droit courant
				$reqordredroit=$this->db->query("select ordre from `droit` where `droit`.nomcodedroit='".$this->droit."'");
				$resordredroit="999999999999";
				if($reqordredroit)
					$resordredroit=$this->db->fetch_array($reqordredroit);
				//check ss droit possibles
				$reqssdroit=$this->db->query("select * from `droit` where `droit`.ordre > ".$resordredroit['ordre']);
				$resssdroit="999999999999";
				if($reqssdroit)
					while($resssdroit=$this->db->fetch_array($reqssdroit))
						if($this->droit==$resssdroit['nomcodedroit'])
							return true;
				
			}
		
		return false;
	}
	

	
	
	function addGrantTo($elmt,$typeelmt="page",$nomcodedroit="admin")
	{
		$id="0";
		$req=$this->db->query("select id".$typeelmt." from `".$typeelmt."` where nomcode".$typeelmt."='".$elmt."'");
		if($req)
		{
			$res=$this->db->fetch_array($req);
			if($res)
				$id=$res['id'.$typeelmt];
		}
		
		$iddroit="0";
		$req=$this->db->query("select iddroit from `droit` where nomcodedroit='".$nomcodedroit."'");
		if($req)
		{
			$res=$this->db->fetch_array($req);
			if($res)
				$iddroit=$res['iddroit'];
		}
		
		$this->db->query("INSERT INTO `elmt_has_droit` (`idelmt_has_droit`, `idelmt`, `elmt`, `typeelmt`, `iddroit`, `nomcodedroit`) VALUES (NULL,'".$id."','".$elmt."','".$typeelmt."','".$iddroit."','".$nomcodedroit."');");
	
	}
	
	
	function removeGrantTo($elmt,$typeelmt="page",$nomcodedroit="admin")
	{
		$this->db->query("DELETE FROM `elmt_has_droit` WHERE elmt='".$elmt."' and typelemt='".$typeelmt."' and nomcodedroit='".$nomcodedroit."';");
	
	}
	
	
	
	function addDroit($nomcodedroit,$nomdroit,$ordre="50")
	{
		$this->db->query("INSERT INTO `droit` VALUES (NULL,'".$nomcodedroit."','".$nomdroit."','".$ordre."');");
	
	}
	
	
	
	function removeDroit($nomcodedroit)
	{
		if($nomcodedroit!="admin" && $nomcodedroit!="user" && $nomcodedroit!="public")
		{
			$this->db->query("DELETE FROM `elmt_has_droit` WHERE nomcodedroit='".$nomcodedroit."';");
			$this->db->query("DELETE FROM `droit` WHERE nomcodedroit='".$nomcodedroit."';");
		}
		
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