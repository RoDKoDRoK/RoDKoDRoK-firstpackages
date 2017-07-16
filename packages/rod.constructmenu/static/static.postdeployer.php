<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des cases
if(isset($this->includer) && $this->includer->include_pratikclass("colonne") && $this->includer->include_pratikclass("params"))
{
	$instanceColonne=new PratikColonne($this->initer);
	
	//add an instancecase menu named adminmanu to colonne colonnedroite
	$instanceColonne->addInstanceCaseToColonne("constructmenu","menu","colonnedroite","10");
	
	//add access to instancecase adminmenu
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("constructmenu","instancecase","admin");
	}
	
	$instanceParams=new PratikParams($this->initer);
	
	//parametre menu admin
	$instanceParams->addParam("constructmenu","instancecase","menuname","construct");
	$instanceParams->addParam("constructmenu","instancecase","menutpl","rightcolumn");
}


?>