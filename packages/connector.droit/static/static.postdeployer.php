<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits pour un user
//if(isset($this->instanceDroit))
//{
	$userinfo=$this->user->getUser("admin");
	$iduser=$userinfo['iduser'];
	
	//$this->instanceDroit->addDroitUser($iduser,"admin"); //$this->instanceDroit pas encore initialisé
	$this->db->query("insert into `user_has_droit` (iduser_has_droit,iduser,nomcodedroit) values (NULL, '".$iduser."', 'admin');");
//}





?>