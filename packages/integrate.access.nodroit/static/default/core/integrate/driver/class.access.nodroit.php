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
	
	function addDroitUser($iduser,$nomcodedroit="public")
	{
		
	}
	
	function delDroitUser($iduser,$nomcodedroit="all")
	{
		
	}

}

?>