<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("globe","page","public");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('globe','main','Globe','?page=globe','Globe','fr_fr','66');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('globe','menu','public');
	}
}


?>