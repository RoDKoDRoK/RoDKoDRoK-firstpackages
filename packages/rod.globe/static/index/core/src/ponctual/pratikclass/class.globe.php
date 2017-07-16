<?php

class PratikGlobe extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
	}
	
	
	function getGlobe()
	{
		$globe="";
		
		//iframe path
		$iframepath="";
		if(class_exists("PratikPath") || (isset($this->includer) && $this->includer->include_pratikclass("Path")))
		{
			$pratikpath=new PratikPath($this->initer);
			$iframepath.=$pratikpath->getHttpRootPath();
			$iframepath.="/";
		}
		
		$iframepath.=$this->arkitect->get("globe.earthpath");
		
		//basepath
		$basepath=parse_url($path.$_SERVER['REQUEST_URI'],PHP_URL_PATH);
		$basepath=substr($basepath,1,strrpos($basepath,"/")-1);
		
		
		//globe
		$globe.= '<input type="hidden" id="basepath" value="'.$basepath.'" />';
		$globe.="<iframe src=\"".$iframepath."\" width=\"70%\" height=\"500px\"></iframe>";
		
		return $globe;
	}
	
	
	
	
}


?>