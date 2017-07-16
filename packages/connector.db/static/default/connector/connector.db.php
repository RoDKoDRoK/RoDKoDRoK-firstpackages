<?php


class ConnectorDb extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance db
		$instanceDb=new Db($this->initer['conf']);
		
		
		//set instance before return
		$this->setInstance($instanceDb);
		
		return $instanceDb;
	}
	
	function initVar()
	{
		//charg db
		$instanceDb=$this->getInstance();
		//print_r($instanceDb->db->conf);

		return $instanceDb->dbselected;
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
		//close db
		$this->initer['db']->deconnexion();
		
		return null;
	}



}



?>
