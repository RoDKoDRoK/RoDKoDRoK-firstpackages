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
	$instanceColonne->addInstanceCaseToColonne("adminmenu","menu","colonnedroite","0");
	
	//add access to instancecase adminmenu
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("adminmenu","instancecase","admin");
	}
	
	$instanceParams=new PratikParams($this->initer);
	
	//parametre menu admin
	$instanceParams->addParam("adminmenu","instancecase","menuname","admin");
	$instanceParams->addParam("adminmenu","instancecase","menutpl","rightcolumn");
}


?>