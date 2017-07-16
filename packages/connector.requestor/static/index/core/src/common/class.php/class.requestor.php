<?php

class Requestor extends ClassIniter
{
	var $reqselected=null;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		//select moteur requestor
		$instance=$this->instanciator->newInstance("requestor",$initer,true);
		
		$this->reqselected=$instance;
	}
	
	
	function getRequestor()
	{
		return $this->reqselected;
	}

}

?>