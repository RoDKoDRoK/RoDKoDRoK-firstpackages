<?php

class LibIntegratorJquery extends LibIntegrator
{

	
	function __construct($initer=array())
	{
		parent::__construct($initer);

	}
	
	
	function charg_jquery()
	{
		$lib="";
		
		$lib.="<script src=\"core/integrate/lib/jquery-2.1.3.min.js\" type=\"text/javascript\"></script>\n";
		
		//$lib.="<script src=\"core/integrate/lib/jquery/js/jquery-ui-1.9.1.custom.min.js\" type=\"text/javascript\"></script>\n";
		
		//$lib.="<link rel=\"stylesheet\" type=\"text/css\" href=\"core/integrate/lib/jquery/css/jquery-ui-1.9.1.custom.min.css\">\n";
		
		return $lib;
	}
	
	
	function addtodb()
	{
		$uniquelib="1";
		$defaultlib=$this->nomcodelib;
		$this->instanceLib->addLib($this->nomcodelib,$this->nomcodelib,$this->nomcodelib,$this->nomcodelibtype,$this->nomcodelibtype,$this->nomcodelibtype,$uniquelib,$defaultlib);
		$this->instanceLib->addLibToChain($this->nomcodelib);
		return null;
	}
	
	
}



?>