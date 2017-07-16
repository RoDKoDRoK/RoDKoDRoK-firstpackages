<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("packager","page","admin");
	$this->instanceDroit->addGrantTo("driverelmtlist","ajax","admin");
	$this->instanceDroit->addGrantTo("elmtlist","ajax","admin");
	$this->instanceDroit->addGrantTo("foldercontent","ajax","admin");
	$this->instanceDroit->addGrantTo("dbtablelist","ajax","admin");
	$this->instanceDroit->addGrantTo("chaincontent","ajax","admin");
	$this->instanceDroit->addGrantTo("pack","ajax","admin");
	$this->instanceDroit->addGrantTo("addtopack","ajax","admin");
	$this->instanceDroit->addGrantTo("delfrompack","ajax","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('packager','main','Packager','?page=packager','Création de packages','fr_fr','67');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('packager','menu','admin');
	}
}


?>