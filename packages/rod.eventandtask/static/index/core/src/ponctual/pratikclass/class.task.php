<?php

class PratikTask extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function addTask($nomcodetask,$typetask,$nomtask="",$description="")
	{
		//prepare data
		$nomcodetask=strtolower($nomcodetask);
		$typetask=strtolower($typetask);
		
		//check task already exists
		$reqexists=$this->db->query("select * FROM `task` WHERE `task`.typetask='".$typetask."' and (`task`.nomcodetask='".$nomcodetask."' or `task`.idtask='".$nomcodetask."')");
		if($resexists=$this->db->fetch_array($reqexists))
		{
			$idtask=$resexists['idtask'];
			//update not used
			/*$req=$this->db->query("update `task` set 
										typetask='".$typetask."', 
										nomtask='".$nomtask."', 
										description='".$description."'
									where idtask='".$idtask."'
									");
			*/
		}
		else
		{
			$this->db->query("insert into `task` (idtask,nomcodetask,typetask,nomtask,description) VALUES (NULL,'".$nomcodetask."','".$typetask."','".$nomtask."','".$description."')");
			$idtask=$this->db->last_insert_id();
		}
		
		return $idtask;
	}
	
	
	function updateTask($nomcodetask,$typetask="",$tabupdate=array())
	{
		if(is_array($tabupdate) && count($tabupdate)==0)
			return;
		
		//check idtask to update
		$idtask="0";
		if(is_numeric($nomcodetask))
		{
			$idtask=$nomcodetask;
		}
		else
		{
			//prepare data
			$nomcodetask=strtolower($nomcodetask);
			$typetask=strtolower($typetask);
			
			//load task id
			$reqtask=$this->db->query("select * FROM `task` WHERE `task`.typetask='".$typetask."' and `task`.nomcodetask='".$nomcodetask."'");
			if($restask=$this->db->fetch_array($reqtask))
				$idtask=$restask['idtask'];
		}
		
		//prepare update
		$update="";
		foreach($tabupdate as $idtab=>$valuetab)
		{
			$update.=$idtab."='".$valuetab."' , ";
		}
		$update=substr($update,0,-2);
		
		//update
		$this->db->query("update `task` set 
										".$update." 
									where idtask='".$idtask."'
									");
		
	} 
	
	
	function delTask($nomcodetask="",$typetask="")
	{
		//prepare data
		$nomcodetask=strtolower($nomcodetask);
		$typetask=strtolower($typetask);
		
		//delete
		$this->db->query("delete from `task` where `task`.typetask='".$typetask."' and (idtask='".$nomcodetask."' or nomcodetask='".$nomcodetask."')");
	}

}


?>