<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des tasks aux events
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	$instanceEvent->delTaskFromEvent("SyncEvent","onChainLoad");
	$instanceEvent->delTaskFromEvent("SyncTask","onChainLoad");
}

//syncevent and synctask (first tasks for self package : manual config only for package rod.eventandtask)
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	$instanceEvent->delEvent("onChainLoad");
}
if(isset($this->includer) && $this->includer->include_pratikclass("task"))
{
	$instanceTask=new PratikTask($this->initer);
	$instanceTask->delTask("SyncEvent","cron");
	$instanceTask->delTask("SyncTask","cron");
}



?>