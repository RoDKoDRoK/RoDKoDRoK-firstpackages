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
		
		$content.="YES!";
		
		$content.="<br />";
		$content.="<input type=\"button\" name=\"test\" value=\"Test Ajax\" onclick=\"ajaxCall('ajaxdiv','example','".$this->db->conf['lang']."');\" />";
		$content.="<br />";
		$content.="<div id='ajaxdiv'></div>";
		
		return $content;
	}


}


?>