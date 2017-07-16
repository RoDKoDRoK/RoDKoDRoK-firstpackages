<?php

class PackageStatus extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function form_loader()
	{
		$form=array();
		
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		
		//load tab status file disponibles
		$packagefilename=$packagecodename.$this->instanceConf->get("extpackage");
		$tabstatusfiles=array();
		if($this->includer->include_pratikclass("Downloader"))
		{
			$downloader=new PratikDownloader($this->initer);
			
			//official package
			$filenamecour=$downloader->getFileLink($packagefilename,"packages");
			if($filenamecour!="")
			{
				$tabstatusfiles[]=array();
				$tabstatusfiles[count($tabstatusfiles)-1]['codevalue']=$statuscour;
				$tabstatusfiles[count($tabstatusfiles)-1]['value']=$packagefilename;
			}
			
			//status packages
			$tabstatus=$this->instanceConf->get("status");
			foreach($tabstatus as $statuscour)
			{
				$filenamecour=$downloader->getFileLink($packagefilename."-".$statuscour,"statuspackages");
				
				if($filenamecour!="")
				{
					$tabstatusfiles[]=array();
					$tabstatusfiles[count($tabstatusfiles)-1]['codevalue']=$statuscour;
					$tabstatusfiles[count($tabstatusfiles)-1]['value']=$packagefilename."-".$statuscour;
				}
			}
		}
		
		
		$preform=array();
		
		$preform['classicform']=true;
		
		$preform['deployafterstatusbutton']=true;
		
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform']) -1]['label']="";
		$preform['lineform'][count($preform['lineform']) -1]['hiddenlabel']="on";
		$preform['lineform'][count($preform['lineform']) -1]['name']="packagecodename";
		$preform['lineform'][count($preform['lineform']) -1]['default']=$packagecodename;
		$preform['lineform'][count($preform['lineform']) -1]['champs']="hidden";
		
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform']) -1]['label']="Package status";
		$preform['lineform'][count($preform['lineform']) -1]['hiddenlabel']="on";
		$preform['lineform'][count($preform['lineform']) -1]['name']="status";
		$preform['lineform'][count($preform['lineform']) -1]['default']="";
		$preform['lineform'][count($preform['lineform']) -1]['champs']="select";
		$preform['lineform'][count($preform['lineform']) -1]['suggestlist']=$tabstatusfiles;
		
		//construct form
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform);
		}
	
		return $form;
	}
	
	
	
	function data_loader()
	{
		$data=array();
		
		//data
		$data['deployed']=$this->instanceVar->varpost("deployed");
		$data['packagecodename']=$this->instanceVar->varpost("packagecodename");
		
		return $data;
	}
	
	
	
	function windowcontent_loader()
	{
		$content="";
		
		$deployed=$this->instanceVar->varpost("deployed");
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		
		//status select
		$content.=$this->instanceLang->getTranslation("Select status package (dev, test, alpha, beta, ...) for ".$packagecodename);
		
		return $content;
	}
	
	
	function windowtitle_loader()
	{
		$content="";
		
		$deployed=$this->instanceVar->varpost("deployed");
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		
		$variabletext="Deploy older";
		if($reverse=="reverse")
			$variabletext="Reverse";
		
		$content.="<h2>".$this->instanceLang->getTranslation("Status packages ".$packagecodename)."</h2>";
	
		return $content;
	}
}


?>