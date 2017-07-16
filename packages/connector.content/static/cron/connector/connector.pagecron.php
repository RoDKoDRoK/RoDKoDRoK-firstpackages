<?php


class ConnectorPagecron extends Connector
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
		//récup cron
		$cron="error";

		//récup mode page web
		if(isset($_GET['cron']) && $_GET['cron']!="")
			$cron=$_GET['cron'];
		//récup mode console
		else if(isset($this->argv[3]) && $this->argv[3]!="")
			$cron=$this->argv[3];
			
		if(!file_exists("core/server/crontab/cron/".$cron.".php"))
			$cron="error";



		//récup droit du user
		if(!$this->instanceDroit->hasAccessTo($cron,"cron"))
			$cron="error";

		return $cron;
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
