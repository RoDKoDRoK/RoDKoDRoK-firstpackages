<?php

class Event extends ClassIniter
{
	var $returned;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
		//chargement event
		/*
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			$params=array();
			
			$pratikevent=new PratikEvent($this->initer);
			$this->returned=$pratikevent->execEvent("onChainLoad",$params);
		}
		*/
		
		$this->returned=$this->execEventEnDurPourRodChainAndConnector(); // to replace later by code before
	}
	
	
	
	//exec event onpageload
	function execEventEnDurPourRodChainAndConnector()
	{
		//force exec cron chain and connectors
		if(isset($this->includer) && $this->includer->include_otherclass("cron","syncchain"))
		{
			$instanceCron=new SyncChain($this->initer);
			$instanceCron->launchcron();
		}
		
		if(isset($this->includer) && $this->includer->include_otherclass("cron","syncconnector"))
		{
			$instanceCron=new SyncConnector($this->initer);
			$instanceCron->launchcron();
		}
	}
	
}



?>