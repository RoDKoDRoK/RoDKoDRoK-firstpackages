<?php


class ConnectorLang extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//import lang du user connecté
		$lang_to_use="";
		if(isset($this->userloaded['lang']))
			$lang_to_use=$this->userloaded['lang'];
		
		//import langue
		$this->initer['conf']['lang']="";
		if(isset($this->initer['conf']['defaultlang']))
			$this->initer['conf']['lang']=$this->initer['conf']['defaultlang'];
		//cas page web ou ajax
		if(isset($_SESSION['lang']) && $_SESSION['lang']!="")
			$this->initer['conf']['lang']=$_SESSION['lang'];
		//cas cron, terminal ou ws
		if(isset($lang_to_use) && $lang_to_use!="")
			$this->initer['conf']['lang']=$lang_to_use;
		$this->initer['db']->conf=$this->initer['conf'];
			
		$instanceLang=new Lang($this->initer['conf']['lang'],$this->initer['page']);
		
		
		//set instance before return
		$this->setInstance($instanceLang);
		
		return $instanceLang;
	}
	
	function initVar()
	{
		//charg conf
		$instanceLang=$this->getInstance();
		//print_r($instanceLang->lang);

		return $instanceLang->lang;
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
