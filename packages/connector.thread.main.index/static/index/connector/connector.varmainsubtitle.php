<?php


class ConnectorVarmainsubtitle extends Connector
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
		$mainsubtitle="";
		if(isset($this->initer['conf']['mainsubtitle']))
			$mainsubtitle=$this->initer['conf']['mainsubtitle'];

		return $mainsubtitle;
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
