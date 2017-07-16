<?php

class PratikChain extends ClassIniter
{	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function addChain($nomcodechain,$nomchain="",$description="")
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
		
		return $idchain;
		
	}
	
	
	function delChain($nomcodechain="")
	{
		//delete
		$this->db->query("delete from `chain` where (idchain='".$nomcodechain."' or nomcodechain='".$nomcodechain."')");
		
	}
	
	
	
}


?>