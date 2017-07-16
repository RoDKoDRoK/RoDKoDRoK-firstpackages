<?php


class ConnectorInstanciatorextended extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance instanceInstanciatorextended to replace/surcharge instanciator in initer
		$instanceInstanciatorextended=new Instanciatorextended($this->initer);
		
		
		//set instance before return
		$this->setInstance($instanceInstanciatorextended);
		
		return $instanceInstanciatorextended;
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
