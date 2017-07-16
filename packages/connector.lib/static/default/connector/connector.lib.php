<?php


class ConnectorLib extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceLib=new Lib($this->initer);
		
		
		//set instance before return
		$this->setInstance($instanceLib);
		
		return $instanceLib;
	}
	
	function initVar()
	{
		//charg conf
		$instanceLib=$this->getInstance();
		//print_r($instanceLib->returned);
		
		return $instanceLib->returned;
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
