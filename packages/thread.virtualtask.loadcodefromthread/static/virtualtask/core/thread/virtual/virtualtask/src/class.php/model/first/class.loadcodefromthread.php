<?php

class Loadcodefromthread extends VirtualTask
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function execvirtualtask($params=array())
	{
		$code=$params['code'];
		
		//thread folder to load files path in tab (to load files later)
		$cheminthreadtoload=$this->arkitect->get("thread.".$this->chainconnector).$this->arkitect->get("ext.src")."/".$code.$this->arkitect->get("ext.thread");
		//if(!file_exists($cheminthreadtoload))
		//	$cheminthreadtoload=$this->arkitect->get("thread.".$this->chainconnector).$this->arkitect->get("ext.src")."/".$code;
		
		$tabcodefilethread=array();
		if(is_dir($cheminthreadtoload))
			$tabcodefilethread=$this->loader->charg_dossier_dans_tab($cheminthreadtoload);
		
		return $tabcodefilethread;
	}





}

?>