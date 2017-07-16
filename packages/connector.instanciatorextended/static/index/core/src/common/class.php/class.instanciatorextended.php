<?php

class Instanciatorextended extends ClassIniter
{	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function newInstance($classname="",$initer=array(),$autoinclude=true,$forcedriver=false,$multidriver=false,$multidriverreturnone=false)
	{
		//check data
		if($classname=="")
		{
			//putolog... test if log exists before !!!
			return null;
		}
			
		//prepare data
		//$classname=strtolower($classname);
		$classname=ucfirst($classname);
		
		//multidriver
		if($multidriver)
		{
			$moteurname=strtolower($classname);
			
			 //chargement des formaters
			$tab_chemins_driver=$this->loader->charg_dossier_dans_tab($this->arkitect->get("integrate.driver"));
			
			$tabdrivers=array();
			if($tab_chemins_driver)
				foreach($tab_chemins_driver as $chemin_driver_to_load)
				{
					if($drivername=strstr($chemin_driver_to_load,"class.".$moteurname."."))
					{
						$drivername=substr($drivername,strrpos($drivername,"class.".$moteurname.".")+strlen("class.".$moteurname."."),-4);
						$drivername=strtolower($drivername);
						$driverclass=ucfirst($drivername);
						
						include $chemin_driver_to_load;
						eval("\$instanceDriver=new ".$classname.$driverclass."(\$initer);");
						
						//check new instance ok with initer parameters
						$tabdrivers[$drivername]=null;
						if($this->checkIniterPrerequis($instanceDriver))
							$tabdrivers[$drivername]=$instanceDriver;
						
					}
				}
			
			//cas return one driver of tab multiple drivers
			if($multidriverreturnone)
				if($multidriverreturnone=="default" && isset($this->instanceConf) && $this->instanceConf==null)
				{
					$defaultmoteur=$this->instanceConf->get("defaultmoteur".$moteurname);
					if(isset($tabdrivers[$defaultmoteur]))
						return $tabdrivers[$defaultmoteur];
					return null;
				}
				else
				{
					if(isset($tabdrivers[$multidriverreturnone]))
						return $tabdrivers[$multidriverreturnone];
					if(isset($this->instanceConf) && $this->instanceConf==null)
					{
						$defaultmoteur=$this->instanceConf->get("defaultmoteur".$moteurname);
						if(isset($tabdrivers[$defaultmoteur]))
							return $tabdrivers[$defaultmoteur];
					}
					return null;
				}
			
			//return all tab drivers
			return $tabdrivers;
		}
		
		//check class exists
		//auto include
		if(!class_exists($classname) && $autoinclude && !$forcedriver)
		{
			//ark event instanciator_autoinclude
			if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
			{
				//params in code
				$params=array();
				
				//exec event
				$pratikevent=new PratikEvent($this->initer);
				$this->returned=$pratikevent->execEvent("instanciator_autoinclude",$params);
			}
		}
		
		//driver
		if(!class_exists($classname) || $forcedriver)
		{
			//check moteur disponible dans la conf (to load from driver)
			if(!isset($this->instanceConf) || $this->instanceConf==null)
				return null;
			
			$moteurconfname=strtolower($classname);
			$moteur=$this->instanceConf->get("moteur".$moteurconfname);
		  
			//select moteur
			$moteurlowercase=strtolower($moteur);
			$moteurclass=ucfirst($moteurlowercase);
			if(file_exists($this->arkitect->get("integrate.driver")."/class.".$moteurconfname.".".$moteurlowercase.".php"))
			{
				//load moteur
				include_once $this->arkitect->get("integrate.driver")."/class.".$moteurconfname.".".$moteurlowercase.".php";
				$classname.=$moteurclass;
				if(!class_exists($classname))
					return null;
			}
			else
			{
				$defaultmoteur=$this->instanceConf->get("defaultmoteur".$moteurconfname);
				
				$moteurlowercase=strtolower($defaultmoteur);
				$moteurclass=ucfirst($moteurlowercase);
				if(file_exists($this->arkitect->get("integrate.driver")."/class.".$moteurconfname.".".$moteurlowercase.".php"))
				{
					if(isset($this->log) && $this->log!=null)
						$this->log->pushtolog("Echec du chargement du driver ".$moteurconfname." ".$moteurlowercase.". Verifier la configuration ou votre driver.");
					
					//load default moteur
					include_once $this->arkitect->get("integrate.driver")."/class.".$moteurconfname.".".$moteurlowercase.".php";
					$classname.=$moteurclass;
					if(!class_exists($classname))
						return null;
				}
				else
				{
					//putolog... test if log exists before !!!
					return null;
				}
			}
			
		}
		
		
		//new instance
		eval("\$instance=new ".$classname."(\$initer);");
		
		//check new instance ok with initer parameters
		if($this->checkIniterPrerequis($instance))
			return $instance;
		
		//cas prerequis manquant
		//putolog... test if log exists before !!!
		return null;
	}
	
	
	
	
	function checkIniterPrerequis($instance)
	{
		$tabiniterprerequis=$instance->getIniterPrerequis();
		
		//cas pas de prerequis
		if($tabiniterprerequis=="")
			return true;
		
		if(is_array($tabiniterprerequis) && count($tabiniterprerequis)<=0)
			return true;
		
		//check prerequis
		foreach($tabiniterprerequis as $initerprerequiscour)
		{
			if(!isset($instance->{$initerprerequiscour}) || $instance->{$initerprerequiscour}==null)
				return false;
		}
		
		return true;
	}
	
	
}



?>