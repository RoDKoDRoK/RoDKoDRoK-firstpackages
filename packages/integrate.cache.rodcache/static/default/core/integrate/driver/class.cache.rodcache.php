<?php

class CacheRodcache
{
	var $conf;
	var $db;
	var $log;
	
	var $destcache;
	
	
	function __construct($db,$log)
	{
		//parent::__construct();
		$this->conf=$db->conf;
		$this->db=$db;
		
		$this->log=$log;
		
	}
	
	
	function preparecachedest($typeelmt,$elmt,$lang,$droit,$uid)
	{	
		//set folder
		if(!is_dir($this->conf['cachedirname']))
			mkdir($this->conf['cachedirname'],0777,true);
		
		//set random name
		do
		{
			$this->destcache=bin2hex(mcrypt_create_iv(55, MCRYPT_DEV_URANDOM));
		}
		while(file_exists($this->conf['cachedirname']."/".$this->destcache));
		
		//select dans db elmt_has_cache puis récup cache dest existant ou create cache dest
		$res=$this->db->query_one_result("select * from `elmt_has_cache` where typeelmt='".$typeelmt."' and elmt='".$elmt."' and lang='".$lang."' and iduser='".$uid."'");
		if($res)
		{
			$this->destcache=$res['cachedest'];
			
			$duration="60";
			if(isset($this->conf['cacheduration']))
				$duration=$this->conf['cacheduration'];
			if(strtotime($res['date'])<strtotime("-".$duration." mins"))
				unlink($this->conf['cachedirname']."/".$this->destcache);
				
		}
		else
			$this->db->query("insert into `elmt_has_cache` values (NULL,'0','".$elmt."','".$typeelmt."','".$lang."','".$uid."','".$this->destcache."','".date("Y-m-d H:i:s")."')");
		

	}
	
	function writecache($datas)
	{
		if(!is_dir($this->conf['cachedirname']))
			mkdir($this->conf['cachedirname'],0777,true);
		
		file_put_contents($this->conf['cachedirname']."/".$this->destcache,$datas);
	}
	
	function readcache()
	{
		$datacached="";
		
		if(file_exists($this->conf['cachedirname']."/".$this->destcache))
			$datacached.=file_get_contents($this->conf['cachedirname']."/".$this->destcache);
		
		return $datacached;
	}


}

?>