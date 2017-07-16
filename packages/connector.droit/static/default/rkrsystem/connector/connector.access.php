<?php


class ConnectorAccess extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceAccess=new Droit($this->initer['conf'],$this->initer['log'],$this->initer['db']);
		
		
		//set instance before return
		$this->setInstance($instanceAccess);
		
		return $instanceAccess;
	}
	
	function initVar()
	{
		//charg conf
		$instanceAccess=$this->getInstance();
		//print_r($instanceAccess->droitselected);

		return $instanceAccess->droitselected;
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
