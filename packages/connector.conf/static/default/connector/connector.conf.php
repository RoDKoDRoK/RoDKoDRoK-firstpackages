<?php


class ConnectorConf extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceConf=new Conf();
		
		
		//set instance before return
		$this->setInstance($instanceConf);
		
		return $instanceConf;
	}
	
	function initVar()
	{
		//charg conf
		$instanceConf=$this->getInstance();
		//print_r($instanceConf->conf);

		return $instanceConf->conf;
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
