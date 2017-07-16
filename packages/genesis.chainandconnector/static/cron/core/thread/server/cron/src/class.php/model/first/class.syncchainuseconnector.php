<?php

class Syncchainuseconnector extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
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
				
				include $this->arkitect->get("chain")."/connector.chain.".$chain.".php";
				
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
	
	
	
	
	function checkCronIsExecutable($params=array())
	{
		$tabchain=$this->loader->charg_chain_dans_tab();
		
		foreach($tabchain as $chain)
		{
			//check nb connector tabconnector != nb entries in db table chainuseconnector
			
			//count nbconnectorinchain db
			$nbconnectorinchaindb=0;
			//from file db
			$tabtmp=$this->genesisdbfromfile->join("inner", "", "chain", "chainuseconnector", array("idchain"=>"idchain"));
			$tabtmp=$this->genesisdbfromfile->where("", "nomcodechain", $chain, $tabtmp);
			$nbconnectorinchaindb=$this->genesisdbfromfile->count("",$tabtmp);
			//from db
			if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("chainuseconnector"))
			{
				$reqcheck=$this->db->query("select count(idchainuseconnector) as nbchainuseconnector FROM `chainuseconnector`,`chain` where `chainuseconnector`.idchain=`chain`.idchain and `chain`.nomcodechain='".$chain."'");
				if($rescheck=$this->db->fetch_array($reqcheck))
				{
					$nbconnectorinchaindb=$rescheck['nbchainuseconnector'];
				}
			}
		
			//count nb connector in chain cour
			include $this->arkitect->get("chain")."/connector.chain.".$chain.".php";
			$nbconnectorinchaintab=count($tabconnector);
			
			if($nbconnectorinchaintab!=$nbconnectorinchaindb)
			{
				return true;
			}
		}
		
		return false;
	}
	
	


}

?>