<?php

class LibIntegratorCanvg
{

	
	function __construct()
	{
		//parent::__construct();

	}
	
	
	function charg_canvg()
	{
		$lib="";
		
		$lib.="<script src=\"core/integrate/lib/canvg/rgbcolor.js\"></script>";
		$lib.="<script src=\"core/integrate/lib/canvg/canvg.js\"></script>";
		
		return $lib;
	}

	
}



?>