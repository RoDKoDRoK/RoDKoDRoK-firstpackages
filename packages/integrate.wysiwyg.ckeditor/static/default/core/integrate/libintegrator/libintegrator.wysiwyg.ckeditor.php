<?php

class LibIntegratorCkeditor extends LibIntegrator
{

	
	function __construct($initer=array())
	{
		parent::__construct($initer);

	}
	
	
	function charg_ckeditor()
	{
		$lib="";
		
		$lib.="<script type=\"text/javascript\" src=\"core/integrate/lib/ckeditor/ckeditor.js\"></script>\n";

		return $lib;
	}

	
}



?>