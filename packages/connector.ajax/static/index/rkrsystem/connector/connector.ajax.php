<?php


class ConnectorAjax extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance ajax
		$instanceAjax=new Ajax($this->initer['conf'],$this->initer['log']);
		
		
		//set instance before return
		$this->setInstance($instanceAjax);
		
		return $instanceAjax;
	}
	
	function initVar()
	{
		//charg ajax
		$instanceAjax=$this->getInstance();
		//print_r($instanceAjax->returned);
		
		return $instanceAjax->returned;
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
