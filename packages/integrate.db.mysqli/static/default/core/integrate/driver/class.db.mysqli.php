<?php

class DbMysqli
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
		$db=mysqli_connect($this->conf['database'][$this->dbname]['host'],$this->conf['database'][$this->dbname]['login'],$this->conf['database'][$this->dbname]['pwd'],$this->conf['database'][$this->dbname]['bd']);
		
		return $db;
	}
	
	function query($req="")
	{
		if($req!="")
			return mysqli_query($this->db,$req);
		
		return null;
	}
	
	function fetch_array($res)
	{
		if($res!="")
			return mysqli_fetch_array($res);
		
		return null;
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
		mysqli_close($this->db);
	}
	
	function last_insert_id()
	{
		return mysqli_insert_id();
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