			
	
				

	
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
	
	
	function data_loader($id)
	{
		$data=array();
		
		//get data
		$sqlreq="";
		$sqlreq.="select * from sharedpackage";

		//$sqlreq.=" left join user on sharedpackage.idauthor=user.iduser";

		$sqlreq.=" where idsharedpackage='".$id."'";
		
		
		$req=$this->db->query($sqlreq);
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
