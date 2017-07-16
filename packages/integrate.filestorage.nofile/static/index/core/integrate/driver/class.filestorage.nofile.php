<?php

class FilestorageNofile
{
	var $conf;
	var $log;
	var $includer;
	
	
	function __construct($conf,$log=null,$includer=null)
	{
		//parent::__construct();
		$this->conf=$conf;
		$this->log=$log;
		$this->includer=$includer;
		
	}
	
	
	function storeFile($filepath="",$dest="",$params=array())
	{
		
		return null;
	}
	
	function killFile($filename="",$position="",$params=array())
	{
		
		return null;
	}
	
	function moveFile($filepath="",$dest="",$params=array())
	{
		
		return null;
	}
	
}

?>