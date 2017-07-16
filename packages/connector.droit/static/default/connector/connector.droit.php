<?php


class ConnectorDroit extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceDroit=$this->initer['instanceAuth']->instanceDroit;
		
		$instanceDroit->getDroitUser();
		
		//set instance before return
		$this->setInstance($instanceDroit);
		
		return $instanceDroit;
	}
	
	function initVar()
	{
		//charg conf
		$instanceDroit=$this->getInstance();
		

		return $instanceDroit->droit;
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
