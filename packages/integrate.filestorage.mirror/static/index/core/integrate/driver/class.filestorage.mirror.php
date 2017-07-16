<?php

class FilestorageMirror
{
	var $conf;
	var $log;
	var $includer;
	
	var $instanceMirror=null;
	
	
	function __construct($conf,$log=null,$includer=null)
	{
		//parent::__construct();
		$this->conf=$conf;
		$this->log=$log;
		$this->includer=$includer;
		
		$this->initer->conf=$conf;
		$this->initer->log=$log;
		$this->initer->includer=$includer;
		
		if($this->includer->include_pratikclass("mirror"))
			$this->instanceMirror=new PratikMirror($this->initer);
	}
	
	
	function storeFile($filepath="",$dest="",$params=array())
	{
		//convert $dest (mirror) to pathdest
		$pathdest=$dest;
		if($this->instanceMirror)
			$pathdest=$this->instanceMirror->getMirrorLink($dest);
		
		//get filename
		$filename=substr($filepath,strrpos($filepath,"/"));
		
		//set pathdest
		$pathdest.="/".$filename;
		
		//move file
		rename($filepath,$pathdest);
		return null;
	}
	
	function killFile($filename="",$position="",$params=array())
	{
		//convert $dest (mirror) to pathdest
		$pathdest=$position;
		if($this->instanceMirror)
			$pathdest=$this->instanceMirror->getMirrorLink($position);
		
		//set pathdest
		$pathdest.="/".$filename;
		
		//move file
		unlink($pathdest);
		return null;
	}
	
	function moveFile($filepath="",$dest="",$params=array())
	{
		//convert $dest (mirror) to pathdest
		$pathdest=$dest;
		if($this->instanceMirror)
			$pathdest=$this->instanceMirror->getMirrorLink($dest);
		
		//get filename
		$filename=substr($filepath,strrpos($filepath,"/"));
		
		//set pathdest
		$pathdest.="/".$filename;
		
		//move file
		rename($filepath,$pathdest);
		return null;
	}
	
}

?>