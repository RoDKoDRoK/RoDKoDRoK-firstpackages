<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$this->instanceDroit->addGrantTo("devandshare","page","admin");
	$this->instanceDroit->addGrantTo("devandshareconfirm","ajax","admin");
}

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	//menus
	$instanceMenu->addMenu('devandshare','admin','Dev & Share','?page=devandshare','Dev & Share','fr_fr','69');
	
	//droits des menus
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo('devandshare','menu','admin');
	}
}


?>