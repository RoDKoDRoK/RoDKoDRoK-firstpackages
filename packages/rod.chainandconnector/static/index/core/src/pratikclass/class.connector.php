<?php

class PratikConnector extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	
	function addConnector($nomcodeconnector,$nomconnector="",$description="")
	{
		//check connector already exists
		$reqexists=$this->db->query("select * FROM `connector` WHERE `connector`.nomcodeconnector='".$nomcodeconnector."' or `connector`.idconnector='".$nomcodeconnector."'");
		if($resexists=$this->db->fetch_array($reqexists))
		{
			$idconnector=$resexists['idconnector'];
			//update not used
			/*$req=$this->db->query("update `connector` set 
										nomlibtype='".$nomconnector."', 
										description='".$description."'
									where idconnector='".$idconnector."'
									");
			*/
		}
		else
		{
			$this->db->query("insert into `connector` (idconnector,nomcodeconnector,nomconnector,description) VALUES (NULL,'".$nomcodeconnector."','".$nomconnector."','".$description."')");
			$idconnector=$this->db->last_insert_id();
		}
		
		return $idconnector;
	}
	
	
	function updateConnector($nomcodeconnector,$tabupdate=array())
	{
		if(is_array($tabupdate) && count($tabupdate)==0)
			return;
		
		//check idconnector to update
		$idconnector="0";
		if(is_numeric($nomcodeconnector))
		{
			$idconnector=$nomcodeconnector;
		}
		else
		{
			//load default lib id
			$reqlib=$this->db->query("select * FROM `connector` WHERE `connector`.nomcodeconnector='".$nomcodeconnector."'");
			if($reslib=$this->db->fetch_array($reqlib))
				$idconnector=$reslib['idconnector'];
		}
		
		//prepare update
		$update="";
		foreach($tabupdate as $idtab=>$valuetab)
		{
			$update.=$idtab."='".$valuetab."' , ";
		}
		$update=substr($update,0,-2);
		
		//update
		$this->db->query("update `connector` set 
										".$update." 
									where idconnector='".$idconnector."'
									");
		
	}
	
	
	function delConnector($nomcodeconnector="")
	{
		//delete
		$this->db->query("delete from `connector` where (idconnector='".$nomcodeconnector."' or nomcodeconnector='".$nomcodeconnector."')");
	}
	
	
	
	function addConnectorToChain($nomcodeconnector,$tabnomcodechain="all",$ordre="0",$classtoiniter="0",$vartoiniter="0",$aliasiniter="",$outputaction="")
	{
		//check and prepare data
		if($classtoiniter==false)
			$classtoiniter="0";
		if($classtoiniter==true)
			$classtoiniter="1";
		if($vartoiniter==false)
			$vartoiniter="0";
		if($vartoiniter==true)
			$vartoiniter="1";
		
		//check and prepare tabnomcodechain
		if($tabnomcodechain=="none")
			return true;
		
		$tabidchain=array();
		if($tabnomcodechain=="all")
		{
			$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain!='default'");
			while($reschain=$this->db->fetch_array($reqchain))
				$tabidchain[]=$reschain['idchain'];
			
		}
		else if(is_array($tabnomcodechain))
		{
			foreach($tabnomcodechain as $nomcodechaincour)
			{
				$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain='".$nomcodechaincour."'");
				if($reschain=$this->db->fetch_array($reqchain))
					$tabidchain[]=$reschain['idchain'];
			}
		}
		else
		{
			$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain='".$tabnomcodechain."'");
			if($reschain=$this->db->fetch_array($reqchain))
				$tabidchain[]=$reschain['idchain'];
		}
		
		//get idconnector
		$idconnector="0";
		if(is_numeric($nomcodeconnector))
		{
			$idconnector=$nomcodeconnector;
		}
		else
		{
			//load lib id
			$reqlib=$this->db->query("select * FROM `lib` WHERE `lib`.nomcodeconnector='".$nomcodeconnector."'");
			if($reslib=$this->db->fetch_array($reqlib))
				$idconnector=$reslib['idconnector'];
		}
		
		//insert chainuseconnector
		if(count($tabidchain)>0)
			foreach($tabidchain as $idchaincour)
			{
				$this->db->query("insert into `chainuseconnector` (idchainuseconnector,idchain,idconnector,ordre,classtoiniter,vartoiniter,aliasiniter,outputaction) VALUES (NULL,'".$idchaincour."','".$idconnector."','".$ordre."','".$classtoiniter."','".$vartoiniter."','".$aliasiniter."','".$outputaction."')");
			}
		
		return true;
		
	}
	
	
	function delConnectorFromChain($nomcodeconnector="",$nomcodechain="all")
	{
		//TODO...prise en compte $nomcodechain
		
		//delete
		$this->db->query("delete from `chainuseconnector` where (idconnector='".$nomcodeconnector."' or nomcodeconnector='".$nomcodeconnector."')");
		
	}
	

}


?>