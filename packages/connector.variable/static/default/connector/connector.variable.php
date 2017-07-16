<?php


class ConnectorVariable extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//import variables getter
		$instanceVar=new Variable();
		
		
		//set instance before return
		$this->setInstance($instanceVar);
		
		return $instanceVar;
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
