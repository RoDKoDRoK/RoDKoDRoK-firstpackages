<?php

class Globe extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.="<div class='paragraphe'>";
		$content.=$this->instanceLang->getTranslation("Globe terrestre");
		$content.="</div>";
		
		return $content;
	}
	
	
	
	function globe_loader($nolimit=false,$nosearch=false)
	{
		$globe="";
		
		//search
		if($this->includer->include_pratikclass("Globe"))
		{
			$instanceGlobe=new PratikGlobe($this->initer);
			$globe=$instanceGlobe->getGlobe();
		}
	
		return $globe;
	}
	
	
	function form_loader()
	{
		//generate the same form for each package
		$preform=array();
		
		$preform['searchglobesubmit']=true;
		
		
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
	
		$globecible=$this->instanceVar->varpost("globecible");
		
		if($this->instanceVar->varpost("searchglobesubmit"))
		{
			$this->instanceVar->varpost($globecible);
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Recherche de ".$globecible));
			
			
			//vider le cache de template
			//$this->tpl->clear_cache_template("all","manual");
			
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