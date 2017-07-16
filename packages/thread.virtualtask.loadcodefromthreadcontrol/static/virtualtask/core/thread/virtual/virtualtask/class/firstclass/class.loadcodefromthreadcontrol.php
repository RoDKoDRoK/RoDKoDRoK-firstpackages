<?php

class Loadcodefromthreadcontrol extends VirtualTask
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
		
		$controlcour="";
		if(isset($this->page)) //later to replace by if(isset($this->control))
			$controlcour=$this->page; //later to replace by $controlcour=$this->control;
		$chemincontroltoload=$this->arkitect->get("thread.".$this->chainconnector).$this->arkitect->get("ext.src")."/".$code.$this->arkitect->get("ext.control").$code."/".$controlcour.".".$code;
		
		$tabcodefilecontrol=array();
		if(file_exists($chemincontroltoload))
			$tabcodefilecontrol=array($chemincontroltoload);
		
		return $tabcodefilecontrol;
	}





}

?>