<?php


class LibIntegrator extends ClassIniter
{
	var $nomcodelib="";
	var $nomcodelibtype="other";
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	

	function addtodb()
	{
		$this->instanceLib->addLib($this->nomcodelib,$this->nomcodelib,$this->nomcodelib,$this->nomcodelibtype,$this->nomcodelibtype,$this->nomcodelibtype);
		$this->instanceLib->addLibToChain($this->nomcodelib);
		return null;
	}
	
	
	function delfromdb()
	{
		$this->instanceLib->delLib($this->nomcodelib);
		$this->instanceLib->delLibToChain($this->nomcodelib);
		return null;
	}
	
	
	
	
	function getNomcodelib()
	{
		return $this->nomcodelib;
	}
	
	function setNomcodelib($nomcodelib)
	{
		$this->nomcodelib=$nomcodelib;
	}
	
	
	function getNomcodelibtype()
	{
		return $this->nomcodelibtype;
	}
	
	function setNomcodelibtype($nomcodelibtype)
	{
		$this->nomcodelibtype=$nomcodelibtype;
	}
	

}



?>
