<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("example","page","admin");
	$this->instanceDroit->addGrantTo("formexample","page","admin");
	$this->instanceDroit->addGrantTo("example","ajax","admin");
	$this->instanceDroit->addGrantTo("example","ws","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('example','main','Example','?page=example','Example','fr_fr','99');
	$instanceMenu->addMenu('formexample','main','FormExample','?page=formexample','Form Example','fr_fr','100');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('example','menu','admin');
		$this->instanceDroit->addGrantTo('formexample','menu','admin');
	}
}


?>