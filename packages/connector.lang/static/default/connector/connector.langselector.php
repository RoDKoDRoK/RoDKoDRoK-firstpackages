<?php


class ConnectorLangselector extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceLangSelector=new LangSelector();
		
		
		//set instance before return
		$this->setInstance($instanceLangSelector);
		
		return $instanceLangSelector;
	}
	
	function initVar()
	{
		return null;
	}

	function preexec()
	{
		$instanceLangSelector=$this->getInstance();
		$instanceLangSelector->lang_submit();
		
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
