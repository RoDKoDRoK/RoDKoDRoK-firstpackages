<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/


//suppr des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->removeGrantTo("contact","page","public");
}

//suppr des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->deleteMenu('contact');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->removeGrantTo('contact','menu','public');
	}
}


?>