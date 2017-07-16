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
		
		//init data
		$tabcodefilecontrol=array();
		
		$controlcour="";
		if(isset($this->page)) //later to replace by if(isset($this->control))
			$controlcour=$this->page; //later to replace by $controlcour=$this->control;
		
		//load secundary
		
		//load first
		
		//load control root
		$chemincontroltoload=$this->arkitect->get("thread.".$this->chainconnector).$this->arkitect->get("ext.src")."/".$code.$this->arkitect->get("ext.model")."/".$controlcour.".".$code;
		
		if(!file_exists($chemincontroltoload))
		{
			//cas nom de fichier inversé
			$tabcode=explode(".",$code);
			if(count($tabcode)!=2)
				return array();
			
			$chemincontroltoload=$this->arkitect->get("thread.".$this->chainconnector).$this->arkitect->get("ext.src")."/".$code.$this->arkitect->get("ext.model")."/".$tabcode[0].".".$controlcour.".".$tabcode[1];
		}
		
		if(file_exists($chemincontroltoload))
			$tabcodefilecontrol[]=$chemincontroltoload;
		
		
		return $tabcodefilecontrol;
	}





}

?>