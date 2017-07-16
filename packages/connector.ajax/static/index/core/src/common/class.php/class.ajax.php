<?php

class Ajax extends Load
{
	var $returned;
	
	
	function __construct($conf,$log)
	{
		//parent::__construct();
		$this->conf=$conf;
		$this->log=$log;
		
		
		//moteur ajax
		$moteurlowercase="";
		if(isset($this->conf['moteurajax']))
			$moteurlowercase=strtolower($this->conf['moteurajax']);
		
		//chargement driver ajax associé pour rodkodrok
		$this->returned=$this->charg_driver_ajax($moteurlowercase);
		
	}
	
	
	
	//driver ajax to load
	function charg_driver_ajax($moteurajaxlowercase="")
	{
		$driver="";
		
		if(file_exists("core/integrate/driver/ajax.".$moteurajaxlowercase.".js"))
			$driver.="<script src=\"core/integrate/driver/ajax.".$moteurajaxlowercase.".js\" type=\"text/javascript\"></script>\n";
		
		return $driver;
	}
	
}



?>