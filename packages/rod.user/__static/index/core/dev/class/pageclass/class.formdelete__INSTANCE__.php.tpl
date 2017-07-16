<?php

class Form{$classnom} extends ClassIniter
{	
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	
	
	function content_loader()
	{
		$content="";
		
		$content.="";
		
		return $content;
	}
	
	
	function form_loader($typeform="delete",$params=array())
	{
		$form=array();
		
		$preform=array();
		if($this->includer->include_dbtableclass("DbTable{$classnom}"))
		{
			$dbtable=new DbTable{$classnom}($this->initer);
			$preform=$dbtable->form($typeform);
		}
		
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform,$params);
		}
	
		return $form;
	}
	
	
	function form_submiter($typeform="delete",$tabaction=array("deldb"),$params=array())
	{
		$submitreturn="";
		
		if($this->instanceVar->varpost("formsubmit"))
		{
			//prepare submit (get form structure, get data post, prepare data to insert into db or to send mail)
			$preform=array();
			if($this->includer->include_dbtableclass("DbTable{$classnom}"))
			{
				$dbtable=new DbTable{$classnom}($this->initer);
				$preform=$dbtable->form($typeform);
			}
			
			//message
			$this->instanceMessage->set_message($this->instanceLang->getTranslation("Suppression effectuee"));
			
			//form delete action
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$instanceForm->submiter($preform,$tabaction,$params);
				
				//redirect
				$submitreturn.=$instanceForm->redirectAfterSubmiter("index.php?page=list{$tablenom}");
			}
		}
		
		return $submitreturn;
	}


}


?>