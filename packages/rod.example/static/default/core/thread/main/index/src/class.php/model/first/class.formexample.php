<?php

class Formexample extends ClassIniter
{
	var $preform=null;
	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function content_loader()
	{
		$content="";
		
		$content.=$this->instanceLang->getTranslation("My form");
		
		return $content;
	}
	
	
	
	function form_loader()
	{
		$form=array();
		
		$preform=$this->getPreform();
		
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform);
		}
	
		return $form;
	}
	
	
	function form_submiter($tabaction=array("todb"))
	{	
		if($this->instanceVar->varpost("formsubmit"))
		{
			//prepare submit (get form structure, get data post, prepare data to insert into db or to send mail)
			$preform=$this->getPreform();
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$instanceForm->submiter($preform,$tabaction);
			}
		}
	}
	
	
	
	function getPreform()
	{
		if(isset($this->preform) && $this->preform!=null)
			return $this->preform;
		
		
		$preform=array();
		
		//construct preform de contact
		
		//init form
		$preform['startform']=true;
		$preform['endform']=true;
		
		$preform['submitbutton']=true;
		$preform['cancelbutton']=true;
		
		//champs form
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform'])-1]['label']=$this->instanceLang->getTranslation("My label");
		$preform['lineform'][count($preform['lineform'])-1]['name']="my_label";
		$preform['lineform'][count($preform['lineform'])-1]['default']="";
		$preform['lineform'][count($preform['lineform'])-1]['suggestlist']="";
		$preform['lineform'][count($preform['lineform'])-1]['champs']="text";
		
		$preform['lineform'][]=array();
		$preform['lineform'][count($preform['lineform'])-1]['label']=$this->instanceLang->getTranslation("My label 2");
		$preform['lineform'][count($preform['lineform'])-1]['name']="my_label_2";
		$preform['lineform'][count($preform['lineform'])-1]['default']="";
		$preform['lineform'][count($preform['lineform'])-1]['suggestlist']="";
		$preform['lineform'][count($preform['lineform'])-1]['champs']="hidden";
		
		//...
		
		
		
		//set var preform
		$this->preform=$preform;
		
		
		return $preform;
	}

}


?>