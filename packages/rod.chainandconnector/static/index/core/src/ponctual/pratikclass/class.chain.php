<?php

class PratikChain extends ClassIniter
{	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function getIniterPrerequis()
	{
		$prerequis=array();
		
		$prerequis[]="db";
		
		return $prerequis;
	}
	
	
	function addChain($nomcodechain,$nomchain="",$description="")
	{
		//prepare data
		$nomcodechain=strtolower($nomcodechain);
		
		
		//dbfromfile
		//check chain already exists
		$idchain=$nomcodechain;
		if(!is_numeric($idchain))
			$idchain=$this->genesisdbfromfile->index("nomcodechain",$nomcodechain,"chain");
		if($idchain!="0")
		{
			//update not used
			/*
			$tabdata=array();
			$tabdata['nomchain']=$nomchain;
			$tabdata['description']=$description;
			
			//$this->updateChain($idchain,$tabdata);
			*/
		}
		else
		{
			//insert event
			$datacour=array();
			$datacour['idchain']=$this->genesisdbfromfile->max("idchain","chain");
			$datacour['idchain']++;
			$datacour['nomcodechain']=$nomcodechain;
			$datacour['nomchain']=$nomchain;
			$datacour['description']=$description;
			
			$this->genesisdbfromfile->insert("chain",$datacour);
			$idchain=$datacour['idchain']; //$this->genesisdbfromfile->count("","param");
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("chain"))
		{
			//check chain already exists
			$reqexists=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain='".$nomcodechain."' or `chain`.idchain='".$nomcodechain."'");
			if($resexists=$this->db->fetch_array($reqexists))
			{
				$idchain=$resexists['idchain'];
				//update not used
				/*$req=$this->db->query("update `chain` set 
											nomchain='".$nomchain."', 
											description='".$description."'
										where idchain='".$idchain."'
										");
				*/
			}
			else
			{
				$this->db->query("insert into `chain` (idchain,nomcodechain,nomchain,description) VALUES (NULL,'".$nomcodechain."','".$nomchain."','".$description."')");
				$idchain=$this->db->last_insert_id();
			}
		}
		
		return $idchain;
	}
	
	
	function delChain($nomcodechain="")
	{
		//prepare data
		$nomcodechain=strtolower($nomcodechain);
		
		
		//dbfromfile
		if(is_numeric($nomcodechain))
		{
			//delete with id
			$this->genesisdbfromfile->delete("chain", $nomcodechain);
		}
		else
		{
			//delete with codename
			$index=$this->genesisdbfromfile->index("nomcodechain",$nomcodechain,"chain");
			$this->genesisdbfromfile->delete("chain", $index);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("chain"))
		{
			//delete
			$this->db->query("delete from `chain` where (idchain='".$nomcodechain."' or nomcodechain='".$nomcodechain."')");
		}
	}
	
	
	
}


?>