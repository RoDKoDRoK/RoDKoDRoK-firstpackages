<?php

class CheckUpdate extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function form_loader()
	{
		$form=array();
		
		$update=$this->instanceVar->varpost("checkupdate");
		
		$preform=array();
		
		$preform['classicform']=true;
		
		$preform['checkupdateconfirmbutton']=true;
		
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
	
	
	
	function windowcontent_loader()
	{
		$content="";
		
		//check updates
		$content.=$this->instanceLang->getTranslation("Check updates for all packages ?");
		
		return $content;
	}
	
	
	function windowtitle_loader()
	{
		$content="";

		$content.="<h2>".$this->instanceLang->getTranslation("Check updates")."</h2>";
	
		return $content;
	}
}


?>