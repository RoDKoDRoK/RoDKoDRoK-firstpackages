<?php

class Multisite extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function reconstructUrl()
	{
		$newurl="";
		
		//cas chain déjà présente
		if(isset($_GET['chain']))
			return false;
		
		//reconstruct url with chain
		$host=$_SERVER['HOST_NAME'];
		$newurl=$_SERVER['REQUEST_URI'];
		
		//cas deploy.php
		if(strstr($newurl,"deploy.php"))
			return false;
		
		$chaincour="none";
		if(isset($this->db) && $this->db!=null)
		{	
			$req=$this->db->query("select * from `multisite` where host='".$host."'");
			while($res=$this->db->fetch_array($req))
			{
				$chaincour=$res['chain'];
			}
		}
		
		if(strpos($newurl,"?"))
			$newurl.="&chain=";
		else
			$newurl.="?chain=";
		$newurl.=$chaincour;
		
		return $newurl;
	}
	
		
}



?>