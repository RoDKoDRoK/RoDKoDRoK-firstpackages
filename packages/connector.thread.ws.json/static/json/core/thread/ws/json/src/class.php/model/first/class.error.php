<?php

class Error extends ClassIniter
{

	var $coderesult="69";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function data_loader()
	{
		$data="";
		
		$data.="MAIN ERROR - WS";
	
		return $data;
	}


}


?>