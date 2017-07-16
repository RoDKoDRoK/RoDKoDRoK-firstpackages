<?php


class ConnectorPageindex extends Connector
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
			if(!file_exists("core/dev/page/".$page.".php"))
				$page="error";
		}

		//check access du user
		if(!$this->initer['instanceDroit']->hasAccessTo($page))
			$page="hasnotaccessto";

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
