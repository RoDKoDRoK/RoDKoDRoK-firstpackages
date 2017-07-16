<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("home","page","public");
	$this->instanceDroit->addGrantTo("error","page","public");
	$this->instanceDroit->addGrantTo("showiniter","ajax","public");
	$this->instanceDroit->addGrantTo("error","ajax","public");
	$this->instanceDroit->addGrantTo("token","ws","public");
	$this->instanceDroit->addGrantTo("error","ws","public");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('home','main','Home','?page=home','Home','fr_fr','1');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("home","menu","public");
	}
}


?>