<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//insert dans arkchain
	$datacour=array();
	$datacour['file']="includer";
	$datacour['makevar']=true;
	$datacour['class']="includer";
	$datacour['var']="includer";
	$datacour['loadafterabstract']=true;
	$this->genesisdbfromfile->insert("arkchain",$datacour);
	
}



?>