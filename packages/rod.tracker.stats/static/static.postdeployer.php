<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("nbvisitorsperperiod","page","admin");
	$this->instanceDroit->addGrantTo("mostvisitedpages","page","admin");
	$this->instanceDroit->addGrantTo("bestvisitors","page","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('tracker','report','Tracker Stats','?page=nbvisitorsperperiod','Tracker Stats','fr_fr','66');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('tracker','menu','admin');
	}
}


?>