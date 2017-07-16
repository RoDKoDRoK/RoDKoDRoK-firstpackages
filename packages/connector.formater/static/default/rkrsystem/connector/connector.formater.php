<?php


class ConnectorFormater extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance formater
		$instanceFormater=new Formater($this->initer['conf'],$this->initer['log']);
		
		
		//set instance before return
		$this->setInstance($instanceFormater);
		
		return $instanceFormater;
	}
	
	function initVar()
	{
		return null;
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
