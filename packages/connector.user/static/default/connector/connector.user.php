<?php


class ConnectorUser extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceUser=new User($this->initer['conf'],$this->initer['log'],$this->initer['db']);
		
		
		//set instance before return
		$this->setInstance($instanceUser);
		
		return $instanceUser;
	}
	
	function initVar()
	{
		//charg conf
		$instanceUser=$this->getInstance();
		

		return $instanceUser->userselected;
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
