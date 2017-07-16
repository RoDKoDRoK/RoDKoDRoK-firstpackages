<?php

class DbNodb
{
	var $conf;
	var $db;
	
	var $dbname;
	
	function __construct($conf,$dbname="maindb")
	{
		//parent::__construct();
		$this->dbname=$dbname;
		$this->conf=$conf;
		$this->db=$this->connexion();
	}
	
	function connexion()
	{
		
		return null;
	}
	
	function query($req)
	{
		return null;
	}
	
	function fetch_array($res)
	{
		return null;
	}
	
	function query_one_result($req)
	{
		return null;
	}
	
	
	function deconnexion()
	{
		
	}
	
	function last_insert_id()
	{
		return null;
	}

	
	function encode($toencode="")
	{
		if(is_array($toencode))
		{
			foreach($toencode as $id=>$value)
				$toencode[$id]=$this->encode($value);
			return $toencode;
		}
		
		return htmlspecialchars(utf8_encode($toencode),ENT_QUOTES);
	}
	
	function decode($todecode="")
	{
		if(is_array($todecode))
		{
			foreach($todecode as $id=>$value)
				$todecode[$id]=$this->decode($value);
			return $todecode;
		}
		
		return htmlspecialchars_decode(utf8_decode($todecode),ENT_QUOTES);
	}

}

?>