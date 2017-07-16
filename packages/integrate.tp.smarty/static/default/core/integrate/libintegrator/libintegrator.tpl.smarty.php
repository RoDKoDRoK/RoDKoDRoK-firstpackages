<?php

class LibIntegratorSmarty
{

	
	function __construct()
	{
		//parent::__construct();

	}
	
	
	function charg_smarty()
	{
		$lib="";
		
		//include lib smarty
		if(!class_exists("Smarty"))
			include_once "core/integrate/lib/Smarty-3.1.21/libs/Smarty.class.php";
		
		return $lib;
	}

	
}



?>