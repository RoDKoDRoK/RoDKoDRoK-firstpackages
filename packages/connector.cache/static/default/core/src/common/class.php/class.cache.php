<?php

class Cache extends ClassIniter
{
	var $cacheselected=null;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		//select moteur requestor
		$instance=$this->instanciator->newInstance("cache",$initer,true);
		
		$this->cacheselected=$instance;
	}
	
	
	function checkcacheisallowed()
	{
		if(isset($_GET['nocache']) && $_GET['nocache']=="ok")
			return false;
			
		return true;
	}
	
	
	function getCache()
	{
		return $this->cacheselected;
	}
	
}



?>