<?php

class Error extends ClassIniter
{

	var $coderesult="69";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="MAIN ERROR - WS";
	
		return $content;
	}


}


?>