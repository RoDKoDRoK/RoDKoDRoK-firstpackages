<?php

class Hasnotaccessto extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="Error - access denied - you should be connected";
	
		return $content;
	}


}


?>