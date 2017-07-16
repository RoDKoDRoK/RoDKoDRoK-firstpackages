<?php


class ConnectorIncluder extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//import includer
		$includer=new Includer($this->initer['instanceConf']);
		
		
		//set instance before return
		$this->setInstance($includer);
		
		return $includer;
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
