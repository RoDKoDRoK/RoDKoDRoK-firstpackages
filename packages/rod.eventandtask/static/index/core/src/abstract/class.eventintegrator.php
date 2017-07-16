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
		$tabreturnedevent=array();
		
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			$instanceEvent=new PratikEvent($this->initer);
			$tabtask=$instanceEvent->getTaskFromEvent($this->nomcodeevent);
			foreach($tabtask as $taskcour)
			{
				//prepare data
				$nomcodetask=strtolower($taskcour['nomcodetask']);
				$nomcodetaskclass=ucfirst($nomcodetask);
				$typetask=strtolower($taskcour['typetask']);
				
				//prepare params from db
				if(isset($this->includer) && $this->includer->include_pratikclass("Params"))
				{
					$instanceParams=new PratikParams($this->initer);
					$paramstaskfromdb=$instanceParams->getParams($nomcodetask,"task");
					$paramscour=array_merge($params,$paramstaskfromdb);
				}
				
				//exec task for event
				if(isset($this->includer) && $this->includer->include_otherclass($typetask,$nomcodetask))
				{
					eval("\$instanceTask=new ".$nomcodetaskclass."(\$this->initer);");
					if($instanceTask->checkTaskIsExecutable($paramscour) && $this->checkEventCanExecuteTask($paramscour))
						$tabreturnedevent[]=$instanceTask->execTask($paramscour);
				}
			}
			
		}
		
		return $tabreturnedevent;
	}
	
	
	function checkEventCanExecuteTask($params=array())
	{
		return true;
		
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
		$this->nomcodeevent=strtolower($nomcodeevent);
	}
	
	

}



?>
