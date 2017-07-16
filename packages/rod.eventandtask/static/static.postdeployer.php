<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

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


/*
//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("home","page","public");
	$this->instanceDroit->addGrantTo("error","page","public");
	$this->instanceDroit->addGrantTo("showiniter","ajax","public");
	$this->instanceDroit->addGrantTo("error","ajax","public");
	$this->instanceDroit->addGrantTo("token","ws","public");
	$this->instanceDroit->addGrantTo("error","ws","public");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('home','main','Home','?page=home','Home','fr_fr','1');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("home","menu","public");
	}
}
*/

?>