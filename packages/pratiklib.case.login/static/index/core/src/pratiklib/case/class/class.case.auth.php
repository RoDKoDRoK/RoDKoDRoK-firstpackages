<?php

class CaseAuth extends ClassIniter
{	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="YES!";
	
		return $content;
	}


}


?>