<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("listsharedpackage","page","public");
	$this->instanceDroit->addGrantTo("viewsharedpackage","page","public");
	$this->instanceDroit->addGrantTo("formsharedpackage","page","admin");
	//$this->instanceDroit->addGrantTo("packageconf","ajax","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('sharedpackage','main','Shared packages','?page=listsharedpackage','Shared packages','fr_fr','66');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('sharedpackage','menu','public');
	}
}


//ajout des tasks aux events
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	
	$instanceEvent->addTaskToEvent("Syncsharedpackage","onChainLoad"); //exécuté sur une page précise avec la parametre suivant
	
	$instanceParams=new PratikParams($this->initer);
	$instanceParams->addParam("syncsharedpackage","task","pagetoexecevent","listsharedpackage");
}




?>