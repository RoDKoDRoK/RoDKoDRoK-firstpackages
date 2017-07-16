<?php


class ConnectorUsertoken extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceUsertoken=new Usertoken($this->initer['conf'],$this->initer['log'],$this->initer['db']);
		
		
		//set instance before return
		$this->setInstance($instanceUsertoken);
		
		return $instanceUsertoken;
	}
	
	function initVar()
	{
		//charg conf
		$instanceUsertoken=$this->getInstance();
		

		return $instanceUsertoken->usertokenselected;
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
