<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des menus
if(isset($this->includer) && $this->includer->include_pratikclass("case"))
{
	$instanceCase=new PratikCase($this->initer);
	
	//cases
	$instanceCase->addCase('custom','custom','custom');
	
	//droits des cases
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("custom","case","public");
	}
}


?>