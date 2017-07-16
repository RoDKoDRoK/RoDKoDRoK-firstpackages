<?php

class SyncChainUseConnector extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron()
	{
		return $this->sync_chain_use_connector();
	
	}


	function sync_chain_use_connector()
	{
		//scan des chain et ajout des new chain dans la db
		$tabchain=$this->loader->charg_chain_dans_tab();
		
		foreach($tabchain as $chain)
		{
			//add to db
			if(isset($this->includer) && $this->includer->include_pratikclass("Connector"))
			{
				$pratikconnector=new PratikConnector($this->initer);
				
				include "chain/connector.chain.".$chain.".php";
				
				$ordre=0;
				foreach($tabconnector as $connectorcour)
				{
					$connectorcour=$this->fillConnectorCourUnsetValues($connectorcour);
					$pratikconnector->addConnectorToChain($connectorcour['name'],$chain,$ordre++,$connectorcour['classtoiniter'],$connectorcour['vartoiniter'],$connectorcour['aliasiniter'],$connectorcour['outputaction']);
				}
			}
			
			
		}
		
		return true;
	}
	
	
	function fillConnectorCourUnsetValues($connectorcour)
	{
		$connectortmp=array();
		$connectortmp['classtoiniter']=false;
		$connectortmp['vartoiniter']=false;
		$connectortmp['aliasiniter']="";
		$connectortmp['outputaction']="";
		$connectortmp['name']="";
		
		$connectortoreturn=array_merge($connectortmp,$connectorcour);
		
		return $connectortoreturn;
	}


}

?>