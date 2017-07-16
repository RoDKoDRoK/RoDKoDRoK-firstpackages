<?php

class TypeCodeLoaderPhpclass extends TypeCodeLoader
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	function load_code_from_file($filecode="")
	{
		$codeloaded="";
		
		$classnamecour=substr($filecode,strrpos($filecode,"/class.")+strlen("/class."),-4);
		$classnamecour=ucfirst($classnamecour);
		
		if(!class_exists($classnamecour) && file_exists($filecode))
			include_once $filecode;
		
		return $codeloaded;
	}
	

}

?>