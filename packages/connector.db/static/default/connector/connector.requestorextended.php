<?php


class ConnectorRequestorextended extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance instanceRequestorextended to replace/surcharge requestor in initer
		$instanceRequestorextended=new Requestorextended($this->initer);
		
		
		//set instance before return
		$this->setInstance($instanceRequestorextended);
		
		return $instanceRequestorextended;
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
