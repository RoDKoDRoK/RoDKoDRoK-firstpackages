<?php

class PratikTask extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function getIniterPrerequis()
	{
		$prerequis=array();
		
		//$prerequis[]="db";
		
		return $prerequis;
	}
	
	
	function addTask($nomcodetask,$typetask,$nomtask="",$description="")
	{
		//prepare data
		$nomcodetask=strtolower($nomcodetask);
		$typetask=strtolower($typetask);
		
		
		//dbfromfile
		//check task already exists
		$idtask=$nomcodetask;
		if(!is_numeric($idtask))
		{
			$tabtmp=$this->genesisdbfromfile->where("", "typetask", $typetask, "task");
			$idtask=$this->genesisdbfromfile->index("nomcodetask",$nomcodetask,$tabtmp,"idtask");
		}
		if($idtask!="0")
		{
			//update not used
			/*
			$tabdata=array();
			$tabdata['typetask']=$typetask;
			$tabdata['nomtask']=$nomtask;
			$tabdata['description']=$description;
			
			$this->updateTask($idtask,$typetask,$tabdata);
			*/
		}
		else
		{
			//insert task
			$datacour=array();
			$datacour['idtask']=$this->genesisdbfromfile->max("idtask","task");
			$datacour['idtask']++;
			$datacour['nomcodetask']=$nomcodetask;
			$datacour['typetask']=$typetask;
			$datacour['nomtask']=$nomtask;
			$datacour['description']=$description;
			
			$this->genesisdbfromfile->insert("task",$datacour);
			$idtask=$datacour['idtask']; //$this->genesisdbfromfile->count("","param");
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("task"))
		{
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
		}
		
		return $idtask;
	}
	
	
	function updateTask($nomcodetask,$typetask="",$tabupdate=array())
	{
		if(!is_array($tabupdate) || (is_array($tabupdate) && count($tabupdate)==0))
			return;
		
		
		//dbfromfile
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
			$tabtmp=$this->genesisdbfromfile->where("", "typetask", $typetask, "task");
			$idtask=$this->genesisdbfromfile->index("nomcodetask",$nomcodetask,$tabtmp,"idtask");
		}
		
		//update
		//prepare data
		$datacour=$tabupdate;
		
		//update event
		$this->genesisdbfromfile->update("task",$idtask,$datacour);
		
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("task"))
		{
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
	} 
	
	
	function delTask($nomcodetask="",$typetask="")
	{
		//prepare data
		$nomcodetask=strtolower($nomcodetask);
		$typetask=strtolower($typetask);
		
		
		//dbfromfile
		if(is_numeric($nomcodetask))
		{
			//delete with id
			$tabtmp=$this->genesisdbfromfile->where("", "typetask", $typetask, "task");
			$idtask=$this->genesisdbfromfile->index("idtask",$nomcodetask,$tabtmp,"idtask");
			
			$this->genesisdbfromfile->delete("task", $idtask);
		}
		else
		{
			//delete with codename
			$tabtmp=$this->genesisdbfromfile->where("", "typetask", $typetask, "task");
			$idtask=$this->genesisdbfromfile->index("nomcodetask",$nomcodetask,$tabtmp,"idtask");
			
			$this->genesisdbfromfile->delete("task", $idtask);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("task"))
		{
			//delete
			$this->db->query("delete from `task` where `task`.typetask='".$typetask."' and (idtask='".$nomcodetask."' or nomcodetask='".$nomcodetask."')");
		}
	}

}


?>