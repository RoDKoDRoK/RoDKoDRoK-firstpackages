<?php


class ConnectorRequestor extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance requestor
		$instance=new Requestor($this->initer);
		
		
		//set instance before return
		$this->setInstance($instance);
		
		return $instance;
	}
	
	function initVar()
	{
		//charg instance requestor
		$instance=$this->getInstance();
		//print_r($instance);
		
		return $instance->getRequestor();
	}

	function preexec()
	{
		return null;
	}

	function postexec()
	{
		return null;
	}

	function end()
	{
		return null;
	}



}



?>
