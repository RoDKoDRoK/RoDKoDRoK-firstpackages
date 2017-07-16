<?php


class ConnectorPagesubajax extends Connector
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
		//récup ajax
		$ajax="error";
		if(isset($_GET['ajax']) && $_GET['ajax']!="")
		{
			$ajax=$_GET['ajax'];
			if(!file_exists($this->arkitect->get("thread.ajax").$this->arkitect->get("ext.control")."/".$ajax.".php"))
				$ajax="error";
		}

		//check access du user
		if(!$this->instanceDroit->hasAccessTo($ajax,"ajax"))
			$ajax="error";

		return $ajax;
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
