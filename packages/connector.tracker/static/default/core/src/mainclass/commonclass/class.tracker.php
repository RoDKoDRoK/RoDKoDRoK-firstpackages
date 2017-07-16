<?php

class Tracker extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function trackCurrentPage()
	{
		//get current page
		$host=$_SERVER['HOST_NAME'];
		$uri=$_SERVER['REQUEST_URI'];
		
		$iduser=0;
		if(isset($this->user->uid))
			$iduser=$this->user->uid;
		
		//save track
		if(isset($this->db) && $this->db!=null)
		{
			$sql="insert into `tracker` (`idtracker`, `lien`, `date`, `iduser`) values (NULL,'".$host.$uri."','".date("Y-m-d H:i:s")."','".$iduser."')";
			$res=$this->db->query($sql);
			return true;
		}
		
		return false;
	}
	
		
}



?>