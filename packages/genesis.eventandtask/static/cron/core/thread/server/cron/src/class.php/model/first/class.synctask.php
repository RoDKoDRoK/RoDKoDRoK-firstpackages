<?php

class Synctask extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
	{
		return $this->sync_task();
	
	}


	function sync_task()
	{
		//scan des folder avec la config istask
		//conf (old system to keep or to kill)
		//$istasktab=$this->instanceConf->get("istask");
		
		$istasktab=$this->genesisdbfromfile->where("", "istask", true, "chainistask");
		if($istasktab!="")
		{
			//load pratikclass task
			$pratiktask=null;
			if(isset($this->includer) && $this->includer->include_pratikclass("Task"))
				$pratiktask=new PratikTask($this->initer);
			
			/*
			foreach($istasktab as $chaincour=>$istaskcour)
			{
				//cas istask false
				if($istaskcour!=true)
					continue;
					
				//set typetask
				$typetask=$chaincour;
			*/
			foreach($istasktab as $istaskcour)
			{
				//cas istask false
				if($istaskcour['istask']!=true)
					continue;
							
				//set typetask
				$typetask=$istaskcour['nomcodechain'];
				
				//chargement liste des tasks de la chain
				//$tabclasspath=$this->instanceConf->get("classpath".$typetask);
				$tabclasspath=$this->genesisdbfromfile->where("", "nomcodechain", $typetask, "classpath");
				if($tabclasspath!="")
					foreach($tabclasspath as $pathcour)
					{
						$pathcour=$pathcour['classpath']; //ajout genesisfromdb
						
						$tabtaskclass=$this->loader->charg_dossier_unique_dans_tab($pathcour);
						if(count($tabtaskclass)>0)
							foreach($tabtaskclass as $taskclass)
							{
								//prepare nomcodetask
								$nomcodetask=substr($taskclass,strlen($pathcour."/class."),(-(strlen(".php"))));
								
								//addtask
								if($pratiktask)
									$pratiktask->addTask($nomcodetask,$typetask,$nomcodetask,$nomcodetask);
							}
					}
			}
		}
		
		return true;
	}
	
	
	function checkCronIsExecutable($params=array())
	{
		//check nb files task (cron, terminal, ...) != nb entries in db table task
		//count nbtask db
		$nbtaskdb=0;
		//from file db
		$nbtaskdb=$this->genesisdbfromfile->count("","task");
		//from db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("task"))
		{
			$reqcheck=$this->db->query("select count(idtask) as nbtask FROM `task`");
			if($rescheck=$this->db->fetch_array($reqcheck))
			{
				$nbtaskdb=$rescheck['nbtask'];
			}
		}
		
		//count nb task files (cron, terminal, ...)
		$nbtaskfiles=0;
		//scan des folder avec la config istask
		//$istasktab=$this->instanceConf->get("istask");
		$istasktab=$this->genesisdbfromfile->where("", "istask", true, "chainistask");
		if($istasktab!="")
		{
			/*
			//enlever genesisfromdb
			foreach($istasktab as $chaincour=>$istaskcour)
			{
				//cas istask false
				if($istaskcour!=true)
					continue;
				
				//set typetask
				$typetask=$chaincour;
			*/	
			foreach($istasktab as $istaskcour)
			{
				//cas istask false
				if($istaskcour['istask']!=true)
					continue;
				
				//set typetask
				$typetask=$istaskcour['nomcodechain'];
				
				//chargement liste des tasks de la chain
				//$tabclasspath=$this->instanceConf->get("classpath".$typetask);
				$tabclasspath=$this->genesisdbfromfile->where("", "nomcodechain", $typetask, "classpath");
				if($tabclasspath!="")
					foreach($tabclasspath as $pathcour)
					{
						$pathcour=$pathcour['classpath']; //ajout genesisfromdb
						
						$tabtaskfilecour=$this->loader->charg_dossier_unique_dans_tab($pathcour);
						$nbtaskfiles+=count($tabtaskfilecour);
					}
			}
		}
		
		if($nbtaskfiles!=$nbtaskdb)
		{
			return true;
		}
		
		return false;
	}
	

}

?>