<?php

class PratikMirror extends ClassIniter
{
	var $publicfoldermirror="";
	var $privatefoldermirror="";
	
	//var $folderdevmirror="dev-mirror-1/";
	//var $folderlocalmirror="local-mirror-1/";
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		$this->publicfoldermirror.=$this->arkitect->get("filestorage.publicfilepath");
		$this->publicfoldermirror.=$this->arkitect->get("mirror.publicsubfilepath");
		
		$this->privatefoldermirror.=$this->arkitect->get("filestorage.privatefilepath");
		$this->privatefoldermirror.=$this->arkitect->get("mirror.privatesubfilepath");
		
	}
	
	
	function createMirror($mirrorname="",$private=false)
	{
		if($mirrorname=="")
			return false;
		
		$mirrorname=str_replace(" ","_",$mirrorname);
		if(!$private)
		{
			if(!file_exists($this->publicfoldermirror."/".$mirrorname))
				mkdir($this->publicfoldermirror."/".$mirrorname,0755);
		}
		else
		{
			if(!file_exists($this->privatefoldermirror."/".$mirrorname))
				mkdir($this->privatefoldermirror."/".$mirrorname,0755);
		}
		
		return true;
	}
	
	
	function getMirrorLink($mirrorname="",$distantpathtomirror="")
	{
		if($mirrorname=="")
			return "";
		
		//cas mirror distant
		if($distantpathtomirror!="")
		{
			$link="";
			
			$link.=$distantpathtomirror."/";
			$link.=$mirrorname."/";
			
			return $link;
		}
		
		//cas mirror local
		$mirrorname=str_replace(" ","_",$mirrorname);
		
		//check if mirrorname is specified in conf with a generic name
		if(isset($this->conf['mirror'][$mirrorname]))
			$mirrorname=$this->conf['mirror'][$mirrorname];
		
		$link="";
		
		$link.=$this->getHttpRootPath();
		$link.=$this->publicfoldermirror."/";
		$link.=$mirrorname."/";
		
		//cas private mirror
		if(!file_exists($link))
		{
			$link="";
			
			$link.=$this->privatefoldermirror."/";
			$link.=$mirrorname."/";
			
			//cas aucun mirror de ce nom existant
			if(!file_exists($link))
				$link="";
			
		}
		
		return $link;
	}
	
	
	function isSecure()
	{
		return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443);
	}
	
	
	function getHttpRootPath()
	{
		$path="";
		$path.="http".($this->isSecure()?"s":"")."://".$_SERVER['HTTP_HOST']."/";
		
		$subfolder=parse_url($path.$_SERVER['REQUEST_URI'],PHP_URL_PATH); //substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"/"));
		$path.=$subfolder."/";
		
		return $path;
	}
	
	
	
}


?>