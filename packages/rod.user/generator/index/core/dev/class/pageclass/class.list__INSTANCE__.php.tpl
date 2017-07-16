<?php

class {$classnom} extends ClassIniter
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
	
	
	function data_loader()
	{
		$data=array();
		
		$sqlreq="";
		$sqlreq.="select * from {$tablenom}";

{if isset($options.hasauthor) && $options.hasauthor == "on"}
		$sqlreq.=" left join user on {$tablenom}.idauthor=user.iduser";
{/if}
		
		
		$req=$this->db->query($sqlreq);
		if($req)
			while($res=$this->db->fetch_array($req))
				$data[]=$res;
		
		
		
		//get structure table
		$tabstruct=array();
		if($this->includer->include_dbtableclass("DbTable{$classnom}"))
		{
			$dbtable=new DbTable{$classnom}($this->initer);
			$tabstruct=$dbtable->structure();
		}
		
		//prepare data to publish
		if($this->includer->include_pratikclass("view"))
		{
			$instanceView=new PratikView($this->initer);
			$data=$instanceView->viewconverter($tabstruct,$data);
		}
		
		
		return $data;
	}


}


?>