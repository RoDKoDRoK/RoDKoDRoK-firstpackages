<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//insert default chain (not used)
	$datacour=array();
	$datacour['nomcodechain']="virtualtask";
	$datacour['istask']=true;
	$this->genesisdbfromfile->insert("chainistask",$datacour);
	
}



?>