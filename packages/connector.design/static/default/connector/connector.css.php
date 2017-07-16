<?php


class ConnectorCss extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		if(isset($this->initer['page']))
			$instanceCss=new Css($this->initer['conf'],$this->initer['page']);
		else
			$instanceCss=new Css($this->initer['conf']);
		
		
		//set instance before return
		$this->setInstance($instanceCss);
		
		return $instanceCss;
	}
	
	function initVar()
	{
		//charg conf
		$instanceCss=$this->getInstance();
		//print_r($instanceCss->returned);

		return $instanceCss->returned;
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
