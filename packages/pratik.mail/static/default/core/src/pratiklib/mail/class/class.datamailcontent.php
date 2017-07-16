<?php

class MainMailContent extends ClassIniter
{
	
	var $data=array();
	
	
	function __construct($initer=array(),$typemail="alert",$data=array())
	{
		parent::__construct($initer);
		
		//prepare datas du mail
		$result=$this->db->query_one_result("select * from mail where type='".$typemail."' and lang='".$this->conf['lang']."'");
		if($result)
		{
			foreach($result as $casemail=>$datamail)
			{
				if(isset($data[$casemail]) && $data[$casemail]!="")
					$result[$casemail]=$data[$casemail];
			}
		}
		else
		{
			$result=$data;
		}
		$this->data=$result;
	}
	
	
	
	function objet_loader()
	{
		$objet="";
		
		$objet.=$this->data['objet'];
	
		return $objet;
	}
	
	
	function content_loader()
	{
		$content="";
		
		$content.=$this->data['texte'];
	
		return $content;
	}
	
	
	function tabdata_loader()
	{
		$content="";
		
		$content.=$this->data['tabdata'];
	
		return $content;
	}


}


?>