<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//create table
	$this->genesisdbfromfile->createTable("chainistask");
	
}



?>