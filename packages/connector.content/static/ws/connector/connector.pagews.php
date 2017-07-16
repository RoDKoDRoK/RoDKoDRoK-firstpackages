<?php


class ConnectorPagews extends Connector
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
		//récup nom ws
		$ws="error";
		if(isset($_GET['ws']) && $_GET['ws']!="")
		{
			$ws=$_GET['ws'];
			if(!file_exists("core/ws/flux/".$ws.".php"))
				$ws="error";
		}

		//check access du user
		if(!$this->instanceDroit->hasAccessTo($ws,"ws"))
			$ws="error";

		return $ws;
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
