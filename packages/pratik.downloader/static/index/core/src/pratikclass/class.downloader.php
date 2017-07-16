<?php

class PratikDownloader extends ClassIniter
{
	var $tabsrclink=array();
	
	var $defaultsrclinkfolder="core/src/pratiklib/downloader/srclinks/";
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		//prepare src links
		$this->tabsrclink=$this->prepareSrcLinks();
	}
	
	
	function prepareSrcLinks()
	{
		$tabsrclink=array();
		
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
		
		ksort($tabsrclink);
		$tabsrclink=array_slice($tabsrclink,0);
		
		//check and prepare local link without http
		if(class_exists("PratikPath") || (isset($this->includer) && $this->includer->include_pratikclass("Path")))
		{
			$pratikpath=new PratikPath($this->initer);
			for($cptsrclink=0;$cptsrclink<count($tabsrclink);$cptsrclink++)
			{
				$urlcour=$tabsrclink[$cptsrclink];
				if(substr($urlcour,0,4)!="http")
					$tabsrclink[$cptsrclink]=$pratikpath->getHttpRootPath().$urlcour;
			}
		}
		else
		{
			//log warning local link not available because Pratik Path not installed
			$this->log->pushtolog("Warning pratik.downloader - local link not available because pratik.path not deployed");
		}
		
		return $tabsrclink;
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