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
	$instanceCase->addCase('menu','menu','menu');
	
	//droits des cases
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("menu","case","public");
	}
}


?>