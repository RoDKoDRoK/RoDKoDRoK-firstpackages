<?php

class DbMysql
{
	var $conf;
	var $db;
	
	function __construct($conf)
	{
		//parent::__construct();
		$this->conf=$conf;
		$this->db=$this->connexion();
	}
	
	function connexion()
	{
		$db=mysqli_connect($this->conf['host'],$this->conf['login'],$this->conf['pwd'],$this->conf['bd']);
		
		return $db;
	}
	
	function query($req)
	{
		return mysqli_query($this->db,$req);
	}
	
	function fetch_array($res)
	{
		return mysqli_fetch_array($res);
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