<?php


class EventIntegrator extends ClassIniter
{
	var $nomcodeevent="";
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function execEvent($params=array())
	{
		$tabtask=$this->getTaskFromEvent($this->nomcodeevent);
		foreach($tabtask as $taskcour)
		{
			if(isset($this->includer) && $this->includer->include_otherclass($taskcour['typetask'],strtolower($taskcour['nomcodetask'])))
			{
				eval("\$instanceTask=new ".$taskcour['nomcodetask']."(\$this->initer);");
				$instanceTask->execTask();
			}
		}
	}
	
	
	function addtodb()
	{
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			$pratikevent=new PratikEvent($this->initer);
			$pratikevent->addEvent($this->nomcodeevent,$this->nomcodeevent,$this->nomcodeevent);
		}
		
		return null;
	}
	
	
	function delfromdb()
	{
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			$pratikevent=new PratikEvent($this->initer);
			$pratikevent->delEvent($this->nomcodeevent);
		}
		
		return null;
	}
	
	
	
	
	function getNomcodeevent()
	{
		return $this->nomcodeevent;
	}
	
	function setNomcodeevent($nomcodeevent)
	{
		$this->nomcodeevent=$nomcodeevent;
	}
	
	

}



?>
