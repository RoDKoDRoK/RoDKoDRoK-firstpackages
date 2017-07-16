<?php

class LibIntegratorSmarty extends LibIntegrator
{

	
	function __construct($initer=array())
	{
		parent::__construct($initer);

	}
	
	
	function charg_smarty()
	{
		$lib="";
		
		//include lib smarty
		if(!class_exists("Smarty"))
			include_once "core/integrate/lib/Smarty-3.1.21/libs/Smarty.class.php";
		
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