<?php

class LibIntegratorFarbtastic
{

	
	function __construct()
	{
		//parent::__construct();

	}
	
	
	function charg_farbtastic()
	{
		$lib="";
		
		//chargement de farbtastic (css uniquement car incompatible avec scriptaculous)
		$lib.="<link rel=\"stylesheet\" type=\"text/css\" href=\"integarte/lib/farbtastic/farbtastic.css\">\n";

		return $lib;
	}

	
}



?>