<?php

class CacheNocache
{
	var $conf;
	var $db;
	var $log;
	
	var $destcache;
	
	
	function __construct($db,$log)
	{
		//parent::__construct();
		$this->conf=$db->conf;
		$this->db=$db;
		
		$this->log=$log;
		
	}
	
	
	function preparecachedest($typeelmt,$elmt,$lang,$droit,$uid)
	{	
		
	}
	
	function writecache($datas)
	{
		
	}
	
	function readcache()
	{
		$datacached="";
		
		return $datacached;
	}


}

?>