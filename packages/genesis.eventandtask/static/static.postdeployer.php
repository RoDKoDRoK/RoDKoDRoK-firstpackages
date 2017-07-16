<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//insert dans arkchain
	$datacour=array();
	$datacour['file']="event";
	$datacour['makevar']=false;
	$datacour['class']="";
	$datacour['var']="";
	$datacour['loadafterabstract']=true;
	$this->genesisdbfromfile->insert("arkchain",$datacour);
	
}


//ajout des tasks aux events
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	$instanceEvent->addTaskToEvent("SyncEvent","onChainLoad");
	$instanceEvent->addTaskToEvent("SyncTask","onChainLoad");
}

//syncevent and synctask (first tasks for self package : manual config only for package rod.eventandtask)
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	$instanceEvent->addEvent("onChainLoad");
}
if(isset($this->includer) && $this->includer->include_pratikclass("task"))
{
	$instanceTask=new PratikTask($this->initer);
	$instanceTask->addTask("SyncEvent","cron");
	$instanceTask->addTask("SyncTask","cron");
}



?>