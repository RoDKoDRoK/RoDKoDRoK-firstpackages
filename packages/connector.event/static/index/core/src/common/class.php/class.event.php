<?php

class Event extends ClassIniter
{
	var $returned;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
		//chargement event onchainload
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			//params in code
			$params=array();
			
			//exec event
			$pratikevent=new PratikEvent($this->initer);
			$this->returned=$pratikevent->execEvent("onchainload",$params);
		}
		
	}
	
	
	
}



?>