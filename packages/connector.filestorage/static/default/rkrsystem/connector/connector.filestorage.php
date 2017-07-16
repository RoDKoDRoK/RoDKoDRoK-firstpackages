<?php


class ConnectorFilestorage extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance filestorage
		$instanceFilestorage=new Filestorage($this->initer['conf'],$this->initer['log'],$this->initer['includer']);
		
		
		//set instance before return
		$this->setInstance($instanceFilestorage);
		
		return $instanceFilestorage;
	}
	
	function initVar()
	{
		$instanceFilestorage=$this->getInstance();
		
		return $instanceFilestorage->getDefaultFileStorage();
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
