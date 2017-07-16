<?php

class Check extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function form_loader()
	{
		$form=array();
		
		//$check=$this->instanceVar->varpost("check");
		
		$preform=array();
		
		$preform['classicform']=true;
		
		$preform['checkupdateconfirmbutton']=true;
		$preform['checkreverseconfirmbutton']=true;
		
		//preform reload option
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform']) -1]['label']="";
		$preform['lineform'][count($preform['lineform']) -1]['hiddenlabel']="on";
		$preform['lineform'][count($preform['lineform']) -1]['name']="reload";
		$preform['lineform'][count($preform['lineform']) -1]['default']="canceled";
		$preform['lineform'][count($preform['lineform']) -1]['champs']="hidden";
		
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
		
		//check updates or reverse
		$data['check']=$this->instanceVar->varpost("check");
		
		return $data;
	}
	
	
	
	function windowcontent_loader()
	{
		$content="";
		
		$check=$this->instanceVar->varpost("check");
		
		$tochecktext="updates";
		if($check=="reverse")
			$tochecktext="reverse";
			
		//check updates or reverse
		$content.=$this->instanceLang->getTranslation("Check ".$tochecktext." for all packages ?");
		
		return $content;
	}
	
	
	function windowtitle_loader()
	{
		$content="";
		
		$check=$this->instanceVar->varpost("check");
		
		$tochecktext="updates";
		if($check=="reverse")
			$tochecktext="reverse";
		
		$content.="<h2>".$this->instanceLang->getTranslation("Check ".$tochecktext)."</h2>";
	
		return $content;
	}
}


?>