<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des cases
if(isset($this->includer) && $this->includer->include_pratikclass("colonne") && $this->includer->include_pratikclass("params"))
{
	$instanceColonne=new PratikColonne($this->initer);
	
	//add an instancecase menu named reportmenu to colonne colonnedroite
	$instanceColonne->addInstanceCaseToColonne("reportmenu","menu","colonnedroite","100");
	
	//add access to instancecase reportmenu
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("reportmenu","instancecase","admin");
	}
	
	$instanceParams=new PratikParams($this->initer);
	
	//parametre menu admin
	$instanceParams->addParam("reportmenu","instancecase","menuname","report");
	$instanceParams->addParam("reportmenu","instancecase","menutpl","rightcolumn");
}


?>