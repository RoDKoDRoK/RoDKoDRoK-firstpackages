<?php

class PratikPath extends ClassIniter
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function isSecure()
	{
		return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443);
	}
	
	function getHttpRootPath()
	{
		$path="";
		$path.="http".($this->isSecure()?"s":"")."://".$_SERVER['HTTP_HOST']."/";
		
		$subfolder=parse_url($path.$_SERVER['REQUEST_URI'],PHP_URL_PATH);
		$subfolder=substr($subfolder,0,strrpos($subfolder,"/"));
		$path.=$subfolder."/";
		
		return $path;
	}
	
	
	
}


?>