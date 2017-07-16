<?php

class Instanciatorextended extends ClassIniter
{	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function newInstance($classname="",$initer=array(),$forcedriver=false)
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
		
		//check class exists
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