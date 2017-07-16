<?php

class AccessNodroit
{
	var $conf;
	var $db;
	
	var $uid="none";
	var $droit="";
	
	
	function __construct($conf,$db=null)
	{
		$this->conf=$conf;
		$this->db=$db;
		
	}
	
	function getDroitUser()
	{
		
		$this->droit="";
		return "";
	}
	
	
	function checkUserLogin($login,$pwd)
	{
		
		return null;
	}
	
	
	
	
	function getUserToken($login,$pwd,$typetoken="ws")
	{
		
		return "";
	}
	
	
	
	
	function checkUserToken($token,$uid,$typetoken="ws")
	{
		
		return null;
	}
	
	
	
	function hasAccessTo($elmttoaccess,$typeelmttoaccess="page")
	{
		
		return true;
	}
	

	
	
	function addGrantTo($elmt,$typeelmt="page",$nomcodedroit="admin")
	{
		
	}
	
	
	function removeGrantTo($elmt,$typeelmt="page",$nomcodedroit="admin")
	{
		
	}
	
	
	
	function addDroit($nomcodedroit,$nomdroit,$ordre="50")
	{
		
	}
	
	
	
	function removeDroit($nomcodedroit)
	{
		
		
	}

	

}

?>