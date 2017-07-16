<?php

class TypeCodeLoaderJs extends TypeCodeLoader
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	function load_code_from_file($filecode="")
	{
		$codeloaded="";
		
		if(substr($filecode,-2)=="js" && file_exists($filecode))
			$codeloaded.="<script src=\"".$filecode."\"></script>\n";
		
		return $codeloaded;
	}
	

}

?>