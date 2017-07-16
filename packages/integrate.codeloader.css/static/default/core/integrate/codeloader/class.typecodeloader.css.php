<?php

class TypeCodeLoaderCss extends TypeCodeLoader
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	function load_code_from_file($filecode="")
	{
		$codeloaded="";
		
		if(substr($filecode,-3)=="css" && file_exists($filecode))
			$codeloaded.="<link rel=\"stylesheet\" href=\"".$filecode."\" type=\"text/css\" />\n";
		
		return $codeloaded;
	}
	

}

?>