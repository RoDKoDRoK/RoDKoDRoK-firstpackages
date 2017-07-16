<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//create table
	$this->genesisdbfromfile->createTable("chain");
	$this->genesisdbfromfile->createTable("connector");
	$this->genesisdbfromfile->createTable("chainuseconnector");
	
	/*
	//insert default chain (not used)
	$datacour=array();
	$datacour['nomcodechain']="default";
	$datacour['nomchain']="default";
	$datacour['description']="default";
	$this->genesisdbfromfile->insert("chain",$datacour);
	*/
	
}



?>