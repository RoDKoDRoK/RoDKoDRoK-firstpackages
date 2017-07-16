<?php

class Error extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="Error - page inexistante";
	
		return $content;
	}


}


?>