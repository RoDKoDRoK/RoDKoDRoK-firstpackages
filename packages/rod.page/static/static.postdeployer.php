<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("page","page","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('page','construct','Page','?page=page','Page','fr_fr','66');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('page','menu','admin');
	}
}


?>