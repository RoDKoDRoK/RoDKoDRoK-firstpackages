<?php

{if $instancecour.type == "table"}

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
	
	
	function form_loader($typeform="insert",$params=array())
	{
		$form=array();
		
		$preform=array();
		if($this->includer->include_dbtableclass("DbTable{$classnom}"))
		{
			//get params id
			$id=0;
			if(isset($params['id']))
				$id=$params['id'];
			
			$dbtable=new DbTable{$classnom}($this->initer);
			$preform=$dbtable->form($typeform,$id);
		}
		
		if($this->includer->include_pratikclass("Form"))
		{
			$instanceForm=new PratikForm($this->initer);
			$form=$instanceForm->formconverter($preform,$params);
		}
	
		return $form;
	}
	
	
	function form_submiter($typeform="insert",$tabaction=array("todb"),$params=array())
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
			$messagecour="Modification effectuee";
			if($typeform=="insert")
				$messagecour="Enregistrement effectue";
			$this->instanceMessage->set_message($this->instanceLang->getTranslation($messagecour));
			
			//form action
			if($this->includer->include_pratikclass("Form"))
			{
				$instanceForm=new PratikForm($this->initer);
				$instanceForm->submiter($preform,$tabaction,$params);
				
				//redirect
				if($typeform=="insert")
					$submitreturn.=$instanceForm->redirectAfterSubmiter();
				else
					$submitreturn.=$instanceForm->redirectAfterSubmiter("index.php?page=view{$tablenom}&id=".$params['id']);
			}
		}
		
		return $submitreturn;
	}


}

{/if}
?>