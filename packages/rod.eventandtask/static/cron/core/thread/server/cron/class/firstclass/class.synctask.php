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
		$istasktab=$this->instanceConf->get("istask");
		if($istasktab!="")
		{
			//load pratikclass task
			$pratiktask=null;
			if(isset($this->includer) && $this->includer->include_pratikclass("Task"))
				$pratiktask=new PratikTask($this->initer);
			
			foreach($istasktab as $chaincour=>$istaskcour)
			{
				//cas istask false
				if($istaskcour!=true)
					continue;
				
				//set typetask
				$typetask=$chaincour;
				
				//chargement liste des tasks de la chain
				$tabclasspath=$this->instanceConf->get("classpath".$chaincour);
				if($tabclasspath!="")
					foreach($tabclasspath as $pathcour)
					{
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
		$reqcheck=$this->db->query("select count(idtask) as nbtask FROM `task`");
		if($rescheck=$this->db->fetch_array($reqcheck))
		{
			$nbtaskdb=$rescheck['nbtask'];
		}
		
		//count nb task files (cron, terminal, ...)
		$nbtaskfiles=0;
		//scan des folder avec la config istask
		$istasktab=$this->instanceConf->get("istask");
		if($istasktab!="")
		{
			foreach($istasktab as $chaincour=>$istaskcour)
			{
				//cas istask false
				if($istaskcour!=true)
					continue;
				
				//set typetask
				$typetask=$chaincour;
				
				//chargement liste des tasks de la chain
				$tabclasspath=$this->instanceConf->get("classpath".$chaincour);
				if($tabclasspath!="")
					foreach($tabclasspath as $pathcour)
					{
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