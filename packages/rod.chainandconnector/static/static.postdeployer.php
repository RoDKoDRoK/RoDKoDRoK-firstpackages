<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des tasks aux events
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	
	$instanceEvent->addTaskToEvent("SyncChain","onChainLoad");
	$instanceEvent->addTaskToEvent("SyncConnector","onChainLoad");
	
	
	$instanceEvent->addTaskToEvent("SyncChainUseConnector","onChainLoad"); //exécuté sur une page précise avec la parametre suivant
	
	$instanceParams=new PratikParams($this->initer);
	$instanceParams->addParam("syncchainuseconnector","task","pagetoexecevent","chain");
}



?>