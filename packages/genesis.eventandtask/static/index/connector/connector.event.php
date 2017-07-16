<?php


class ConnectorEvent extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance event
		$instanceEvent=$this->instanciator->newInstance("Event",$this->initer);
		
		
		//set instance before return
		$this->setInstance($instanceEvent);
		
		return $instanceEvent;
	}
	
	function initVar()
	{
		//charg ajax
		$instanceEvent=$this->getInstance();
		//print_r($instanceEvent->returned);
		
		if(isset($instanceEvent->returned))
			return $instanceEvent->returned;
		
		return "";
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
