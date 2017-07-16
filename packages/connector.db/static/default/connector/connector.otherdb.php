<?php


class ConnectorOtherdb extends Connector
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
		//charg db
		$instanceDb=$this->initer['db'];
		//print_r($instanceDb->db->conf);

		$otherdb=array();
		if(isset($conf['database']))
			foreach($conf['database'] as $databasetoload=>$confdatabase)
				if(isset($confdatabase[$this->chainconnector.'loaded']) && $confdatabase[$this->chainconnector.'loaded']=="yes")
					$otherdb[$databasetoload]=$instanceDb->loadAnotherDb($databasetoload);

		
		return $otherdb;
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
		$otherdb=$this->initer['otherdb'];
		
		//close other db
		foreach($otherdb as $otherdbcour)
			$otherdbcour->deconnexion();
	
		return null;
	}



}



?>
