<?php

class Example extends ClassIniter
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	
	
	function content_loader()
	{
		$content="";
		
		$content.="AJAX YES!";
	
		return $content;
	}
	
/*
	//ou bien selon tpl
	function data_loader()
	{
		$data="";
		
		$data="AJAX YES!";
	
		return $data;
	}
*/

}


?>