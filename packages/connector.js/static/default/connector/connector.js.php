<?php


class ConnectorJs extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		if(isset($this->initer['page']))
			$instanceJs=new Js($this->conf,$this->initer['page']);
		else
			$instanceJs=new Js($this->conf);
		
		
		//set instance before return
		$this->setInstance($instanceJs);
		
		return $instanceJs;
	}
	
	function initVar()
	{
		//charg conf
		$instanceJs=$this->getInstance();
		//print_r($instanceJs->returned);

		return $instanceJs->returned;
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
