<?php

class LibIntegratorFckeditor extends LibIntegrator
{

	
	function __construct($initer=array())
	{
		parent::__construct($initer);

	}
	
	
	function charg_fckeditor()
	{
		$lib="";
		
		include_once "core/integrate/lib/fckeditor/fckeditor.php"; 

		return $lib;
	}

	
}



?>