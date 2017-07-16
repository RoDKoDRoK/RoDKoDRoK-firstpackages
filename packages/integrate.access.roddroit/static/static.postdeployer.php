<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->instanceDroit))
{
	$userinfo=$this->user->getUser("admin");
	$iduser=$userinfo['iduser'];
	
	$this->instanceDroit->addDroitUser($iduser,"admin");
}



?>