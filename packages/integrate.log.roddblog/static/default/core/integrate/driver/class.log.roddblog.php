<?php

class LogRoddblog
{
	var $db;
	var $conf;
	
	
	function __construct($conf,$db=null)
	{
		//parent::__construct();
		$this->db=$db;
		$this->conf=$conf;
		
	}
	
	
	
	function pushtolog($line,$srcerror="RODError",$destname="")
	{
		$line=date("Y-m-d|H:i:s||").$line;
		
		if($destname!="")
		{
			$res=$db->query("create table if not exists `".$destname."`");
			$res=$db->query("insert into `".$destname."` values (NULL,'".$line."')");
		}
		else
		{
			$res=$db->query("create table if not exists `log`");
			$res=$db->query("insert into `log` values (NULL,'".$line."')");
		}
		
	}
	
	
	
}



?>