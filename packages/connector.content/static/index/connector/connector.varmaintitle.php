<?php


class ConnectorVarmaintitle extends Connector
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
		if(isset($this->initer['conf']['maintitle']))
			$maintitle=$this->initer['conf']['maintitle'];

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
