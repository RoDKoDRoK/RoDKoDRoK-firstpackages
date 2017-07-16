			
	
				

	
<?php


class Sharedpackage extends ClassIniter
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
	
	
	function droit_loader()
	{
		$droit=array();
		
		if($this->instanceDroit->hasAccessTo("formsharedpackage","page"))
			$droit['edit']=true;
		
		return $droit;
	}
	
	
	function data_loader()
	{
		$data=array();
		
		$sqlreq="";
		$sqlreq.="select * from `sharedpackage`";

		//$sqlreq.=" left join `user` on `sharedpackage`.idauthor=`user`.iduser";
		
		
		$req=$this->db->query($sqlreq);
		if($req)
			while($res=$this->db->fetch_array($req))
				$data[]=$res;
		
		//data convert decode
		$data=$this->db->decode($data);
		
		//get structure table
		$tabstruct=array();
		if($this->includer->include_dbtableclass("DbTableSharedpackage"))
		{
			$dbtable=new DbTableSharedpackage($this->initer);
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
