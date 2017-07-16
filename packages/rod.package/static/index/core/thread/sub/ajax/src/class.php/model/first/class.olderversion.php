<?php

class OlderVersion extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function form_loader()
	{
		$form=array();
		
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		$local=$this->instanceVar->varpost("local");
		
		//load tab olderversionzipfilename 
		$tabolderversion=array();
		if($local)
		{
			$cheminpackageziparchived="core/files/packageziparchived/";
			$tabtmpolderversion=$this->loader->charg_dossier_unique_dans_tab($cheminpackageziparchived.$packagecodename);
			foreach($tabtmpolderversion as $value)
			{
				//nom de fichier
				$value=substr($value,strlen($cheminpackageziparchived.$packagecodename."/"));
				
				$tabolderversion[]=array();
				$tabolderversion[count($tabolderversion)-1]['codevalue']=$value;
				$tabolderversion[count($tabolderversion)-1]['value']=$value;
			}
		}
		else
		{
			if($this->includer->include_pratikclass("Downloader"))
			{
				$downloader=new PratikDownloader($this->initer);
				$tabtmpolderversion=$downloader->getSubfolderLinks("coldpackages/".$packagecodename);
				foreach($tabtmpolderversion as $value)
				{
					$tabolderversion[]=array();
					$tabolderversion[count($tabolderversion)-1]['codevalue']=$value;
					$tabolderversion[count($tabolderversion)-1]['value']=$value;
				}
			}
		}
		
		
		$preform=array();
		
		$preform['classicform']=true;
		
		$preform['reverseafterselectbutton']=true;
		$preform['deployolderversionafterselectbutton']=true;
		
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform']) -1]['label']="";
		$preform['lineform'][count($preform['lineform']) -1]['hiddenlabel']="on";
		$preform['lineform'][count($preform['lineform']) -1]['name']="packagecodename";
		$preform['lineform'][count($preform['lineform']) -1]['default']=$packagecodename;
		$preform['lineform'][count($preform['lineform']) -1]['champs']="hidden";
		
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform']) -1]['label']="Older available version";
		$preform['lineform'][count($preform['lineform']) -1]['hiddenlabel']="on";
		$preform['lineform'][count($preform['lineform']) -1]['name']="olderversionzipfilename";
		$preform['lineform'][count($preform['lineform']) -1]['default']="";
		$preform['lineform'][count($preform['lineform']) -1]['champs']="select";
		$preform['lineform'][count($preform['lineform']) -1]['suggestlist']=$tabolderversion;
		
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
		$data['reverse']=$this->instanceVar->varpost("reverse");
		$data['local']=$this->instanceVar->varpost("local");
		
		return $data;
	}
	
	
	
	function windowcontent_loader()
	{
		$content="";
		
		$reverse=$this->instanceVar->varpost("reverse");
		$packagecodename=$this->instanceVar->varpost("packagecodename");
		
		$variabletext="deploy";
		if($reverse=="reverse")
			$variabletext="reverse";
			
		//check updates or reverse
		$content.=$this->instanceLang->getTranslation("Select older version to ".$variabletext." for ".$packagecodename);
		
		return $content;
	}
	
	
	function windowtitle_loader()
	{
		$content="";
		
		$reverse=$this->instanceVar->varpost("reverse");
		
		$variabletext="Deploy older";
		if($reverse=="reverse")
			$variabletext="Reverse";
		
		$content.="<h2>".$this->instanceLang->getTranslation($variabletext." version")."</h2>";
	
		return $content;
	}
}


?>