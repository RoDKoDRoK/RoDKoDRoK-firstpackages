<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//create table
	$this->genesisdbfromfile->createTable("codesrc");
	$this->genesisdbfromfile->createTable("chainloadcodesrc");
	
	
	//insert dans arkchain
	$datacour=array();
	$datacour['file']="codeloader";
	$datacour['makevar']=false;
	$datacour['class']="";
	$datacour['var']="";
	$datacour['loadafterabstract']=true;
	$this->genesisdbfromfile->insert("arkchain",$datacour);
	
}

?>