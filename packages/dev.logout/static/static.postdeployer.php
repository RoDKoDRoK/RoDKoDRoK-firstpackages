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
	$instanceCase->addCase('auth','auth','auth');
	$instanceCase->addCase('userinfo','userinfo','userinfo');
	
	//droits des cases
	if(isset($this->instanceDroit))
	{
		$this->instanceDroit->addGrantTo("auth","case","public");
		$this->instanceDroit->addGrantTo("userinfo","case","public");
	}
}


?>