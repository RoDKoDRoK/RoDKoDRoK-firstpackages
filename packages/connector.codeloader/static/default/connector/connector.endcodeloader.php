<?php


class ConnectorClassloader extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function init()
	{
		return null;
	}

	function preexec()
	{
		//include classes common et chainconnector courant
		$chemin_common_classes=$this->arkitect->get("src.mainclass").$this->arkitect->get("ext.commonclass");
		$chemin_classes=$this->arkitect->get("src.mainclass")."/".$this->chainconnector.$this->arkitect->get("ext.class");
		
		$tab_common_class=array();
		if(is_dir($chemin_common_classes))
			$tab_common_class=$this->loader->charg_dossier_dans_tab($chemin_common_classes);
		
		$tab_class=array();
		if(is_dir($chemin_classes))
			$tab_class=$this->loader->charg_dossier_dans_tab($chemin_classes);
		
		$tab_class=array_merge($tab_class,$tab_common_class);
		//print_r($tab_class);
		foreach($tab_class as $class_to_load)
		{
			$classnamecour=substr($class_to_load,strrpos($class_to_load,"/class.")+strlen("/class."),-4);
			$classnamecour=ucfirst($classnamecour);
			
			if(!class_exists($classnamecour))
				include_once $class_to_load;
		}
	
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
