<?php

class LibIntegratorScriptaculous
{

	
	function __construct()
	{
		//parent::__construct();

	}
	
	
	function charg_scriptaculous()
	{
		$lib="";
		
		$lib.="<script src=\"integrate/lib/scriptaculous/lib/prototype.js\" type=\"text/javascript\"></script>\n";
		$lib.="<script src=\"integrate/lib/scriptaculous/src/scriptaculous.js\" type=\"text/javascript\"></script>\n";
		$lib.="<script src=\"integrate/lib/scriptaculous/src/effects.js\" type=\"text/javascript\"></script>\n";

		return $lib;
	}

	
}



?>