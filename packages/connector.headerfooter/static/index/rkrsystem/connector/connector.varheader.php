<?php


class ConnectorVarheader extends Connector
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
		$mainheader="";
		if(isset($this->initer['conf']['header']))
			$mainheader=$this->initer['conf']['header'];

		return $mainheader;
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
