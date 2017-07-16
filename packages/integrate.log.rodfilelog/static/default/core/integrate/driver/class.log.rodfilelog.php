<?php

class LogRodfilelog
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
		
		if(!is_dir($this->conf['logdirname']))
			mkdir($this->conf['logdirname'],0777,true);
		if($destname!="")
			file_put_contents($this->conf['logdirname']."/".$destname,$line,FILE_APPEND);
		else
			file_put_contents($this->conf['logdirname']."/".$this->conf['logfilename'],$line,FILE_APPEND);
		
		
	}
	
	
	
}



?>