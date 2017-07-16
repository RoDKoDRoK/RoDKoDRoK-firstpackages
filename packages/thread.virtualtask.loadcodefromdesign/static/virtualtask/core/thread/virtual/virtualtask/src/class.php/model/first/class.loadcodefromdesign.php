<?php

class Loadcodefromdesign extends VirtualTask
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function execvirtualtask($params=array())
	{
		$code=$params['code'];
		
		//limit load to specific code
		$tabauthorizedcode=array();
		$tabauthorizedcode[]="css";
		$tabauthorizedcode[]="js";
		
		if(array_search($code,$tabauthorizedcode)===false)
			return array();
		
		//design load in tab
		$chemindesigntoload=$this->arkitect->get("design.packagecss")."/".$this->instanceConf->get("packagecss");
		
		$tabcodefiledesign=array();
		if($this->instanceConf->get("packagecss")!="" && is_dir($chemindesigntoload))
			$tabcodefiledesign=$this->loader->charg_dossier_dans_tab($chemindesigntoload);
		
		return $tabcodefiledesign;
	}





}

?>