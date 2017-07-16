<?php


class ConnectorPagevirtualvirtualtask extends Connector
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
		//récup virtualtask
		$virtualtask="error";

		//récup mode page web
		if(isset($_GET['virtualtask']) && $_GET['virtualtask']!="")
			$virtualtask=$_GET['virtualtask'];
		//récup mode console
		else if(isset($this->argv[3]) && $this->argv[3]!="")
			$virtualtask=$this->argv[3];
			
		if(!file_exists($this->arkitect->get("thread.virtualtask").$this->arkitect->get("ext.control")."/".$virtualtask.".php"))
			$virtualtask="error";



		//récup droit du user
		if(!$this->instanceDroit->hasAccessTo($virtualtask,"virtualtask"))
			$virtualtask="error";

		return $virtualtask;
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
