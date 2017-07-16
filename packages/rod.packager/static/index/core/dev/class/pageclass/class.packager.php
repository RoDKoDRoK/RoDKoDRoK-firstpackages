<?php

class Packager extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.=$this->instanceLang->getTranslation("Create a package with the elements, folders, files and db tables selected below.");
		
		return $content;
	}
	
	function data_loader()
	{
		$data=array();
		
		$data['titleelmt']="ELMT";
		$data['titlefile']="FILES";
		$data['titledb']="DB TABLES";
		
		$data['titletopack']="TO PACK";
		
		return $data;
	}
	
	
	function form_loader()
	{
		//generate the same form for each package
		$preform=array();
		
		$preform['chainselect']=true;
		$preform['packbutton']=true;
		
		
		$params=array();
		
		$form=array();
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform,$params);
		}
	
		return $form;
	}
	
	
	
	
	function form_submiter()
	{
		$submitreturn="";
	
		$packagecodename=$this->instanceVar->varpost("codename");
		
		$this->includer->include_pratikclass("Packager");
		$instancePackager=new PratikPackager($this->initer);
	
		if($this->instanceVar->varpost("packsubmit"))
		{
			$instancePackager->pack($packagecodename);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Pack package effectue"));
			
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$submitreturn.=$instanceForm->redirectAfterSubmiter();
			}
		}
		
		return $submitreturn;
	}


}


?>