<?php

class Example extends ClassInter
{
	
	var $coderesult="0";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function data_loader()
	{
		$data="";
		
		$data.="YES!";
	
		return $data;
	}


}


?>