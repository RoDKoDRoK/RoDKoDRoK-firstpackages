<?php


class ConnectorVarfooter extends Connector
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
		$maintitle="";
		if(isset($this->initer['conf']['footer']))
			$maintitle=$this->initer['conf']['footer'];

		return $maintitle;
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
