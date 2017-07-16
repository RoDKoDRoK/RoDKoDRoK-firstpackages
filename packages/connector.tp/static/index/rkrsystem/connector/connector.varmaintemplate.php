<?php


class ConnectorVarmaintemplate extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		return null;
	}
	
	function initVar()
	{
		$maintemplate=$this->chainconnector.".tpl";
		if($this->chainconnector=="index" && isset($this->initer['conf']['maintemplate']))
			$maintemplate=$this->initer['conf']['maintemplate'];
		else if(isset($this->initer['conf'][$this->chainconnector.'template']))
			$maintemplate=$this->initer['conf'][$this->chainconnector.'template'];

		return $maintemplate;
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
