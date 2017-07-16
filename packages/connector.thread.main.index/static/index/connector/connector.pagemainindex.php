<?php


class ConnectorPagemainindex extends Connector
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
		//récup page
		$page="home";
		if(isset($_GET['page']) && $_GET['page']!="")
		{
			$page=$_GET['page'];
			if(!file_exists($this->arkitect->get("thread.index").$this->arkitect->get("ext.control")."/".$page.".php"))
				$page="error";
		}

		//check access du user
		if(isset($this->initer['instanceDroit']) && $this->initer['instanceDroit']!=null)
			if(!$this->initer['instanceDroit']->hasAccessTo($page))
				$page="hasnotaccessto";
		
		//check initersimul
		if(isset($this->initer['simul']) && $this->initer['simul']!=null && $this->initer['simul']=="on")
			$page="nocontrol";
		
		return $page;
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
