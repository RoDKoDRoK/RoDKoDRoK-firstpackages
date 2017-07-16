<?php

class Syncconnector extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
	{
		return $this->sync_connector();
	
	}


	function sync_connector()
	{
		//scan des connector et ajout des new connector dans la db
		$tabconnector=$this->loader->charg_connector_dans_tab();
		
		foreach($tabconnector as $connector)
		{
			//add to db
			if(isset($this->includer) && $this->includer->include_pratikclass("Connector"))
			{
				$pratikconnector=new PratikConnector($this->initer);
				$pratikconnector->addConnector($connector);
			}
		}
		
		return true;
	}
	
	
	function checkCronIsExecutable($params=array())
	{
		//check nb files connector != nb entries in db table connector
		
		//count nbconnector db
		$nbconnectordb=0;
		//from file db
		$nbconnectordb=$this->genesisdbfromfile->count("","connector");
		//from db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("connector"))
		{
			$reqcheck=$this->db->query("select count(idconnector) as nbconnector FROM `connector`");
			if($rescheck=$this->db->fetch_array($reqcheck))
			{
				$nbconnectordb=$rescheck['nbconnector'];
			}
		}
		
		//count nb chain files
		$tabconnector=$this->loader->charg_dossier_unique_dans_tab($this->arkitect->get("connector"));
		$nbconnectorfiles=count($tabconnector);
		
		if($nbconnectorfiles!=$nbconnectordb)
		{
			return true;
		}
		
		return false;
	}
	
	

}

?>