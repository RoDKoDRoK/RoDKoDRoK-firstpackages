<?php


class ConnectorPageajax extends Connector
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
			if(!file_exists("core/dev/js/ajax/flux/".$ajax.".php"))
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
