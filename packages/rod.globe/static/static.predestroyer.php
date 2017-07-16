<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//suppr des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->removeGrantTo("globe","page","public");
}

//suppr des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->deleteMenu('globe');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->removeGrantTo('globe','menu','public');
	}
}


?>