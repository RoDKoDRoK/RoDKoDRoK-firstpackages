<?php

class DbMysql
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
		$db=mysql_connect($this->conf['database'][$this->dbname]['host'],$this->conf['database'][$this->dbname]['login'],$this->conf['database'][$this->dbname]['pwd']);
	
		mysql_select_db($this->conf['database'][$this->dbname]['bd'],$db);
		
		return $db;
	}
	
	function query($req)
	{
		return mysql_query($req,$this->db);
	}
	
	function fetch_array($res)
	{
		return mysql_fetch_array($res);
	}
	
	function query_one_result($req)
	{
		$result=$this->query($req." limit 0, 1");
		if($result)
			return $this->fetch_array($result);
		return null;
		
	}
	
	
	function deconnexion()
	{
		mysql_close($this->db);
	}
	
	function last_insert_id()
	{
		return mysql_insert_id();
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