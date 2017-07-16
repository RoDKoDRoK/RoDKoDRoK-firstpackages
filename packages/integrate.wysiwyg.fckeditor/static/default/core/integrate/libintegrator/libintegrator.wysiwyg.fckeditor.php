<?php

class LibIntegratorFckeditor
{

	
	function __construct()
	{
		//parent::__construct();

	}
	
	
	function charg_fckeditor()
	{
		$lib="";
		
		include_once "integrate/lib/fckeditor/fckeditor.php"; 

		return $lib;
	}

	
}



?>