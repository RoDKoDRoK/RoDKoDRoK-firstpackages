<?php

class {$classnom} extends ClassIniter
{
	
	var $coderesult="0";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function data_loader()
	{
		$data=array();
		
		$sqlreq="";
		$sqlreq.="select * from {$tablenom}";
		
		
		$req=$this->db->query($sqlreq);
		while($res=$this->db->fetch_array($req))
			$data[]=$res;
	
		return $data;
	}


}


?>