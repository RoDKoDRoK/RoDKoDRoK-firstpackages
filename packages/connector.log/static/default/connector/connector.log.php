<?php


class ConnectorLog extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceLog=new Log($this->initer['conf'],$this->initer['db']);
		
		
		//set instance before return
		$this->setInstance($instanceLog);
		
		return $instanceLog;
	}
	
	function initVar()
	{
		//charg conf
		$instanceLog=$this->getInstance();
		//print_r($instanceLog->log);

		return $instanceLog->logselected;
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
