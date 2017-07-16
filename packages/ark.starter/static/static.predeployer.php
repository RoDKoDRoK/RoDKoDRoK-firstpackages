<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des droits
if(isset($this->genesisdbfromfile))
{
	//create table
	$this->genesisdbfromfile->createTable("arkchain");
	
	//insert
	$datacour=array();
	$datacour['file']="load";
	$datacour['makevar']=true;
	$datacour['class']="Load";
	$datacour['var']="loader";
	$datacour['loadafterabstract']=false;
	$this->genesisdbfromfile->insert("arkchain",$datacour);
	
	$datacour=array();
	$datacour['file']="arkitect";
	$datacour['makevar']=true;
	$datacour['class']="arkitect";
	$datacour['var']="arkitect";
	$datacour['loadafterabstract']=false;
	$this->genesisdbfromfile->insert("arkchain",$datacour);
	
	$datacour=array();
	$datacour['file']="instanciator";
	$datacour['makevar']=true;
	$datacour['class']="instanciator";
	$datacour['var']="instanciator";
	$datacour['loadafterabstract']=false;
	$this->genesisdbfromfile->insert("arkchain",$datacour);
}



?>