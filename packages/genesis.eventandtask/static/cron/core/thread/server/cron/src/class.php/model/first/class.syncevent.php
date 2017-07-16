<?php

class Syncevent extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
	{
		return $this->sync_event();
	
	}


	function sync_event()
	{
		//scan des eventintegrator et ajout des new event dans la db
		$eventintegratorfolder="core/integrate/event";
		$tabeventintegrator=$this->loader->charg_dossier_unique_dans_tab($eventintegratorfolder);
		
		foreach($tabeventintegrator as $eventintegratorcour)
		{
			//get nomcodeevenr
			$nomcode=substr($eventintegratorcour,strlen($eventintegratorfolder."/eventintegrator."),(-(strlen(".php"))));
			$nomcodeclass=ucfirst($nomcode);
			
			//addtodb
			include_once $eventintegratorcour;
			eval("\$instanceEventIntegrator=new EventIntegrator".$nomcodeclass."(\$this->initer);");
			$instanceEventIntegrator->setNomcodeevent($nomcode);
			$instanceEventIntegrator->addtodb();
		}
		
		return true;
	}
	
	
	function checkCronIsExecutable($params=array())
	{
		//check nb files eventintegrator != nb entries in db table event
		
		//count nbevent db
		$nbeventdb=0;
		//from file db
		$nbeventdb=$this->genesisdbfromfile->count("","event");
		//from db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("event"))
		{
			$reqcheck=$this->db->query("select count(idevent) as nbevent FROM `event`");
			if($rescheck=$this->db->fetch_array($reqcheck))
			{
				$nbeventdb=$rescheck['nbevent'];
			}
		}
		
		//count nb eventintegrator files
		$tabeventintegrator=$this->loader->charg_dossier_unique_dans_tab("core/integrate/event");
		$nbeventfiles=count($tabeventintegrator);
		
		if($nbeventfiles!=$nbeventdb)
		{
			return true;
		}
		
		return false;
	}


}

?>