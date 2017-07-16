<?php


class ConnectorHeaderfooter extends Connector
{
	var $chemintpl="core/design/template/";
	
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
		return null;
	}

	function preexec()
	{
		//header et footer to load for the tpl
		if(file_exists("core/design/class/class.".$this->initer['header'].".php"))
			include_once "core/design/class/class.".$this->initer['header'].".php";
		if(file_exists("core/design/headfoot/".$this->initer['header'].".php"))
			include_once "core/design/headfoot/".$this->initer['header'].".php";
		if(file_exists("core/design/class/class.".$this->initer['footer'].".php"))
			include_once "core/design/class/class.".$this->initer['footer'].".php";
		if(file_exists("core/design/headfoot/".$this->initer['footer'].".php"))
			include_once "core/design/headfoot/".$this->initer['footer'].".php";

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
