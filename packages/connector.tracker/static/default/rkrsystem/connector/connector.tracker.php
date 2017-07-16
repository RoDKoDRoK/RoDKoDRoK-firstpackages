<?php


class ConnectorTracker extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance tracker
		$instanceTracker=new Tracker($this->initer);
		
		//set instance before return
		$this->setInstance($instanceTracker);
		
		return $instanceTracker;
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
		//track page
		$this->instanceTracker->trackCurrentPage();
		
		return null;
	}



}



?>
