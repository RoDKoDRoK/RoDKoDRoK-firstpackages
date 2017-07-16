<?php

class CacheNocache extends CacheDriver
{
	var $destcache;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	}
	
	
	function preparecachedest($typeelmt,$elmt,$lang,$droit,$uid)
	{	
		
	}
	
	function writecache($datas)
	{
		
	}
	
	function readcache()
	{
		$datacached="";
		
		return $datacached;
	}


}

?>