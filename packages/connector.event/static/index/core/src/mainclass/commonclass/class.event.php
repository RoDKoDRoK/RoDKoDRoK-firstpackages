<?php

class Event extends ClassIniter
{
	var $returned;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
		//chargement event onChainLoad
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			//params in code
			$params=array();
			
			//params from db
			if(isset($this->includer) && $this->includer->include_pratikclass("Params"))
			{
				$instanceParams=new PratikParams($this->initer);
				$paramseventfromdb=$instanceParams->getParams("onChainLoad","event");
				$params=array_merge($params,$paramseventfromdb);
			}
			
			//exec event
			$pratikevent=new PratikEvent($this->initer);
			$this->returned=$pratikevent->execEvent("onChainLoad",$params);
		}
		
		//$this->returned=$this->execEventEnDurPourRodChainAndConnector(); // to replace later by code before
	}
	
	
	
	//exec event onpageload
	function execEventEnDurPourRodChainAndConnector()
	{
		//force exec cron chain and connectors
		if(isset($this->includer) && $this->includer->include_otherclass("cron","syncchain"))
		{
			$instanceCron=new Syncchain($this->initer);
			$instanceCron->launchcron();
		}
		
		if(isset($this->includer) && $this->includer->include_otherclass("cron","syncconnector"))
		{
			$instanceCron=new Syncconnector($this->initer);
			$instanceCron->launchcron();
		}
	}
	
}



?>