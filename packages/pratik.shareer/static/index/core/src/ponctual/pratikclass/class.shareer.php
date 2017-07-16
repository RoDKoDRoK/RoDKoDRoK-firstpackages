<?php

class PratikShareer extends ClassIniter
{
	var $tabsrclink=array();
	
	var $defaultsrclinkfolder="core/src/libinternal/pratiklib/shareer/srclinks/"; //set in arkitect
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		//init defaultsrclinkfolder
		$this->defaultsrclinkfolder=$this->arkitect->get("pratiklib.shareer.srclinkfolder");
		
		//prepare src links
		$this->tabsrclink=$this->prepareSrcLinks();
	}
	
	
	function prepareSrcLinks()
	{
		$sharepath=array();
		
		//get folder src link
		$srclinksfolder=$this->defaultsrclinkfolder;
		if(isset($this->conf['srclinkfolder']) && is_dir($this->conf['srclinkfolder']))
			$srclinksfolder=$this->conf['srclinkfolder'];
		
		//load srclinks in array
		$tab_chemins_srclinks=array();
		if(isset($this->loader))
			$tab_chemins_srclinks=$this->loader->charg_dossier_dans_tab($srclinksfolder);
		
		if(isset($tab_chemins_srclinks) && $tab_chemins_srclinks)
			foreach($tab_chemins_srclinks as $chemin_srclinks_to_load)
			{
				if(strstr($chemin_srclinks_to_load,".htaccess")=="" && substr($chemin_srclinks_to_load,-4)==".php")
					include $chemin_srclinks_to_load;
			}
		
		ksort($sharepath);
		$sharepath=array_slice($sharepath,0);
		
		//check and prepare local link without http
		if(class_exists("PratikPath") || (isset($this->includer) && $this->includer->include_pratikclass("Path")))
		{
			$pratikpath=new PratikPath($this->initer);
			for($cptsrclink=0;$cptsrclink<count($sharepath);$cptsrclink++)
			{
				$urlcour=$sharepath[$cptsrclink];
				if(substr($urlcour,0,4)!="http")
					$sharepath[$cptsrclink]=$pratikpath->getHttpRootPath().$urlcour;
			}
		}
		else
		{
			//log warning local link not available because Pratik Path not installed
			$this->log->pushtolog("Warning pratik.shareer - local link not available because pratik.path not deployed");
		}
		
		return $sharepath;
	}
	
	
	function getSrcLink($srclink="")
	{
		if($srclink=="" && isset($this->tabsrclink[0]))
			return $this->tabsrclink[0];
		
		if(is_numeric($srclink) && $srclink>=0 && isset($this->tabsrclink[$srclink]))
			return $this->tabsrclink[$srclink];
		
		return $srclink;
	}
	
	function getTabSrcLink()
	{
		return $this->tabsrclink;
	}
	
	function getFileLink($filename="",$subfolder="")
	{
		for($cptsrclink=0;$cptsrclink<count($this->getTabSrcLink());$cptsrclink++)
		{
			$urltodownload=$this->getSrcLink($cptsrclink);
			$urltodownload=$urltodownload."/".$subfolder."/";
			
			$file_headers = @get_headers($urltodownload.$filename);
			if($file_headers[0] != 'HTTP/1.1 404 Not Found')
			{
				return $urltodownload.$filename;
			}
		}
		
		return "";
	}
	
	function getSubfolderLinks($subfolder="")
	{
		for($cptsrclink=0;$cptsrclink<count($this->getTabSrcLink());$cptsrclink++)
		{
			$urltodownload=$this->getSrcLink($cptsrclink);
			$urltodownload=$urltodownload."/".$subfolder."/";
			
			$file_headers = @get_headers($urltodownload);
			if($file_headers[0] != 'HTTP/1.1 404 Not Found')
			{
				$tabfilesdetected = $this->loader->charg_url_unique_dans_tab($urltodownload);
				if(count($tabfilesdetected)>0)
				{
					return $tabfilesdetected;
				}
			}
		}
		
		return array();
	}
	
	
}



?>