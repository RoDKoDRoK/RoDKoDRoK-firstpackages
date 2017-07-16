<?php

{if $instancecour.type == "table"}

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
		
{if isset($options.hasauthor) && $options.hasauthor == "on"}
		$sqlreq.=" left join user on {$tablenom}.idauthor=user.iduser";
{/if}
		
		
		$req=$this->db->query($sqlreq);
		while($res=$this->db->fetch_array($req))
			$data[]=$res;
	
		return $data;
	}


}

{/if}
?>