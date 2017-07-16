<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des cases
if(isset($this->includer) && $this->includer->include_pratikclass("case"))
{
	$instanceCase=new PratikCase($this->initer);
	
	//cases
	$instanceCase->addCase('lang','lang','lang');
	
	//droits des cases
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("lang","case","public");
	}
}


?>