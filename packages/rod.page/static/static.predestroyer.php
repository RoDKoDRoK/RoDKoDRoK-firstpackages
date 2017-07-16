<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//suppr des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->removeGrantTo("page","page","admin");
}

//suppr des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->deleteMenu('page');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->removeGrantTo('page','menu','admin');
	}
}


?>