<?php


class ConnectorLib extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceLib=new Lib($this->initer);
		
		
		//set instance before return
		$this->setInstance($instanceLib);
		
		return $instanceLib;
	}
	
	function initVar()
	{
		//charg conf
		$instanceLib=$this->getInstance();
		//print_r($instanceLib->returned);
		
		
		//check new libintegrator (to put in connector.event later)
		//count nblib db
		$nblibdb=0;
		$reqcheck=$this->db->query("select count(idlib) as nblib FROM `lib`");
		if($rescheck=$this->db->fetch_array($reqcheck))
		{
			$nblibdb=$rescheck['nblib'];
		}
		
		//count nb libintegrator files
		$tablibintegrator=$this->loader->charg_dossier_unique_dans_tab("core/integrate/libintegrator");
		$nblibfiles=count($tablibintegrator);
		
		if($nblibfiles!=$nblibdb)
		{
			//force exec cron check new libintegrator
			if(isset($this->includer) && $this->includer->include_otherclass("cron","synclibintegrator"))
			{
				$instanceCron=new SyncLibIntegrator($this->initer);
				$instanceCron->launchcron();
			}
		}
		//...check new libintegrator
		

		return $instanceLib->returned;
	}


	function preexec()
	{
		return null;
	}

	function postexec()
	{
		return null;
	}

	function end()
	{
		return null;
	}



}



?>
