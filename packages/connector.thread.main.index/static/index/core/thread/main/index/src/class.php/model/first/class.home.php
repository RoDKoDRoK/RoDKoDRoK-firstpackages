<?php

class Home extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="Bienvenue sur votre nouveau site install&eacute; avec RoDKoDRoK !";
	
		return $content;
	}


}


?>