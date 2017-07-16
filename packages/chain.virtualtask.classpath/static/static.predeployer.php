<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout dans genesis db
if(isset($this->genesisdbfromfile))
{
	//insert classpath
	$datacour=array();
	$datacour['nomcodechain']="virtualtask";
	$datacour['classpath']=$this->arkitect->get("thread.virtualtask").$this->arkitect->get("ext.firstclass")."/";
	$this->genesisdbfromfile->insert("classpath",$datacour);
	
	
	//insert secundaryclasspath
	$datacour=array();
	$datacour['nomcodechain']="virtualtask";
	$datacour['secundaryclasspath']=$this->arkitect->get("thread.virtualtask").$this->arkitect->get("ext.secundaryclass")."/";
	$this->genesisdbfromfile->insert("secundaryclasspath",$datacour);
	
	
}



?>