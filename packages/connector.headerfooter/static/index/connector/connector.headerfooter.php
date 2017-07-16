<?php


class ConnectorHeaderfooter extends Connector
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
		return null;
	}

	function preexec()
	{
		//header et footer to load for the tpl
		if(file_exists($this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.class")."/class.".$this->initer['header'].".php"))
			include_once $this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.class")."/class.".$this->initer['header'].".php";
		if(file_exists($this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.control")."/".$this->initer['header'].".php"))
			include_once $this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.control")."/".$this->initer['header'].".php";
		if(file_exists($this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.class")."/class.".$this->initer['footer'].".php"))
			include_once $this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.class")."/class.".$this->initer['footer'].".php";
		if(file_exists($this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.control")."/".$this->initer['footer'].".php"))
			include_once $this->arkitect->get("design.headerfooter").$this->arkitect->get("ext.control")."/".$this->initer['footer'].".php";

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
