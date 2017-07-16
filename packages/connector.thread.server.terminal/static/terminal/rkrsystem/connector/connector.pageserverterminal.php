<?php


class ConnectorPageserverterminal extends Connector
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
		//récup cmd
		$cmd="error";

		//récup mode page web
		if(isset($_GET['cmd']) && $_GET['cmd']!="")
			$cmd=$_GET['cmd'];
		//récup mode console
		else if(isset($this->argv[3]) && $this->argv[3]!="")
			$cmd=$this->argv[3];
			
		if(!file_exists($this->arkitect->get("thread.terminal").$this->arkitect->get("ext.control")."/".$cmd.".php"))
			$cmd="error";

			

		//récup droit du user
		if(!$this->instanceDroit->hasAccessTo($cmd,"cmd"))
			$cmd="error";

		return $cmd;
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
