<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("packagemanager","page","admin");
	$this->instanceDroit->addGrantTo("packageconf","ajax","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('package','admin','Package','?page=packagemanager','Package','fr_fr','66');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('package','menu','admin');
	}
}


?>