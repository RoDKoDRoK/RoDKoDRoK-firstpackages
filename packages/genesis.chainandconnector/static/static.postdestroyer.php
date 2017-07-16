<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout des tasks aux events
if(isset($this->includer) && $this->includer->include_pratikclass("event"))
{
	$instanceEvent=new PratikEvent($this->initer);
	$instanceEvent->delTaskFromEvent("SyncChain","onChainLoad");
	$instanceEvent->delTaskFromEvent("SyncConnector","onChainLoad");
	//$instanceEvent->delTaskFromEvent("SyncChainUseConnector","onChainLoad");
}


?>