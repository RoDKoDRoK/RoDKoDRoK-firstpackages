<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des cases
if(isset($this->includer) && $this->includer->include_pratikclass("colonne") && $this->includer->include_pratikclass("params"))
{
	$instanceColonne=new PratikColonne($this->initer);
	
	//add case menu admin to colonne
	$instanceColonne->addCaseToColonne("menu","colonnedroite","0");
	
	
	$instanceParams=new PratikParams($this->initer);
	
	//parametre menu admin
	$instanceParams->addParam("colonnedroite","colonne","menuname","admin");
	$instanceParams->addParam("colonnedroite","colonne","menutpl","rightcolumn");
}


?>