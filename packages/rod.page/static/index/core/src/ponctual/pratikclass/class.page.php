<?php

class PratikPage extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
	}
	
	
	function getPage($page="error")
	{
		$page="";
		
		$sqlreq="";
		$sqlreq.="select * from news";
		
		$sqlreq.=" left join user on news.idauthor=user.iduser";
		
		
		$req=$this->db->query($sqlreq);
		while($res=$this->db->fetch_array($req))
			$data[]=$res;
		
		return $page;
	}
	
	
	
	
}


?>