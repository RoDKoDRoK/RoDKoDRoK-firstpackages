<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("deploymanager","page","admin");
	$this->instanceDroit->addGrantTo("downloadstep","page","admin");
	$this->instanceDroit->addGrantTo("configstep","page","admin");
	$this->instanceDroit->addGrantTo("deploystep","page","admin");
	$this->instanceDroit->addGrantTo("deploypackage","ajax","admin");
	$this->instanceDroit->addGrantTo("downloadpackage","ajax","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('deployer','main','Deployer','?page=deploymanager','Deployer','fr_fr','76');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('deployer','menu','admin');
	}
}


?>