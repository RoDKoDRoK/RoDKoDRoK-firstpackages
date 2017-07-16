<?php

class Token extends ClassIniter
{

	var $coderesult="0";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}
	

	function data_loader()
	{
		$data="";
		
		$login=$this->instanceVar->varpost("login");
		$pwd=$this->instanceVar->varpost("pwd");
		
		$newtoken=$this->instanceDroit->getUserToken($login,$pwd,"ws");
		
		if($newtoken=="")
			$this->coderesult="1";
		
		$data.=$newtoken;
	
		return $data;
	}


}


?>