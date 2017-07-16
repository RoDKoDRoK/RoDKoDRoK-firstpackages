<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des colonnes
if(isset($this->includer) && $this->includer->include_pratikclass("colonne"))
{
	$instanceColonne=new PratikColonne($this->initer);
	
	//colonnes
	$instanceColonne->addColonne('colonnedroite','colonnedroite','colonnedroite');
	$instanceColonne->addColonne('colonnegauche','colonnegauche','colonnegauche');
	
	//droits des colonnes
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("colonnedroite","colonne","public");
		$this->instanceDroit->addGrantTo("colonnegauche","colonne","public");
	}
	
	//cases in colonnes
	//$instanceColonne->addCaseToColonne('auth','colonnedroite','1');
	//$instanceColonne->addCaseToColonne('userinfo','colonnedroite','2');
	//...
	
}


?>