<?php

class PratikConnector extends ClassIniter
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
	
	
	function addConnector($nomcodeconnector,$nomconnector="",$description="")
	{
		//prepare data
		$nomcodeconnector=strtolower($nomcodeconnector);
		
		
		//dbfromfile
		//check connector already exists
		$idconnector=$nomcodeconnector;
		if(!is_numeric($idconnector))
			$idconnector=$this->genesisdbfromfile->index("nomcodeconnector",$nomcodeconnector,"connector");
		if($idconnector!="0")
		{
			//update not used
			/*
			$tabdata=array();
			$tabdata['nomconnector']=$nomconnector;
			$tabdata['description']=$description;
			
			$this->updateConnector($idconnector,$tabdata);
			*/
		}
		else
		{
			//insert event
			$datacour=array();
			$datacour['idconnector']=$this->genesisdbfromfile->max("idconnector","connector");
			$datacour['idconnector']++;
			$datacour['nomcodeconnector']=$nomcodeconnector;
			$datacour['nomconnector']=$nomconnector;
			$datacour['description']=$description;
			
			$this->genesisdbfromfile->insert("connector",$datacour);
			$idconnector=$datacour['idconnector']; //$this->genesisdbfromfile->count("","param");
		}
		
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("connector"))
		{
			//check connector already exists
			$reqexists=$this->db->query("select * FROM `connector` WHERE `connector`.nomcodeconnector='".$nomcodeconnector."' or `connector`.idconnector='".$nomcodeconnector."'");
			if($resexists=$this->db->fetch_array($reqexists))
			{
				$idconnector=$resexists['idconnector'];
				//update not used
				/*$req=$this->db->query("update `connector` set 
											nomconnector='".$nomconnector."', 
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
		}
		
		return $idconnector;
	}
	
	
	function updateConnector($nomcodeconnector,$tabupdate=array())
	{
		if(!is_array($tabupdate) || (is_array($tabupdate) && count($tabupdate)==0))
			return;
		
		
		//check idconnector to update
		$idconnector="0";
		if(is_numeric($nomcodeconnector))
		{
			$idconnector=$nomcodeconnector;
		}
		else
		{
			//load connector id
			$idconnector=$this->genesisdbfromfile->index("nomcodeconnector",$nomcodeconnector,"connector");
		}
		
		//update
		//prepare data
		$datacour=$tabupdate;
		
		//update connector
		$this->genesisdbfromfile->update("connector",$idconnector,$datacour);
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("connector"))
		{
			//check idconnector to update
			$idconnector="0";
			if(is_numeric($nomcodeconnector))
			{
				$idconnector=$nomcodeconnector;
			}
			else
			{
				//load connector id
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
	}
	
	
	function delConnector($nomcodeconnector="")
	{
		//prepare data
		$nomcodeconnector=strtolower($nomcodeconnector);
		
		
		//dbfromfile
		if(is_numeric($nomcodeconnector))
		{
			//delete with id
			$this->genesisdbfromfile->delete("connector", $nomcodeconnector);
		}
		else
		{
			//delete with codename
			$index=$this->genesisdbfromfile->index("nomcodeconnector",$nomcodeconnector,"connector");
			$this->genesisdbfromfile->delete("connector", $index);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("connector"))
		{
			//delete
			$this->db->query("delete from `connector` where (idconnector='".$nomcodeconnector."' or nomcodeconnector='".$nomcodeconnector."')");
		}
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
		
		//prepare other data
		$nomcodeconnector=strtolower($nomcodeconnector);
		
		
		//dbfromfile
		//check and prepare tabnomcodechain
		if($tabnomcodechain=="none")
			return true;
		
		$tabidchain=array();
		if($tabnomcodechain=="all")
		{
			$reqchain=$this->genesisdbfromfile->where("", "nomcodechain", "default", "chain","!=");
			foreach($reqchain as $reschain)
				$tabidchain[]=$reschain['idchain'];
			
		}
		else if(is_array($tabnomcodechain))
		{
			foreach($tabnomcodechain as $nomcodechaincour)
			{
				$reqchain=$this->genesisdbfromfile->where("", "nomcodechain", $nomcodechaincour, "chain");
				foreach($reqchain as $reschain)
					$tabidchain[]=$reschain['idchain'];
			}
		}
		else
		{
			$reqchain=$this->genesisdbfromfile->where("", "nomcodechain", $tabnomcodechain, "chain");
			foreach($reqchain as $reschain)
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
			//load connector id
			$idconnector=$this->genesisdbfromfile->index("nomcodeconnector",$nomcodeconnector,"connector");
		}
		
		//insert chainuseconnector
		if(count($tabidchain)>0)
			foreach($tabidchain as $idchaincour)
			{
				//insert chainuseconnector
				$datacour=array();
				$datacour['idchainuseconnector']=$this->genesisdbfromfile->max("idchainuseconnector","chainuseconnector");
				$datacour['idchainuseconnector']++;
				$datacour['idchain']=$idchaincour;
				$datacour['idconnector']=$idconnector;
				$datacour['ordre']=$ordre;
				$datacour['classtoiniter']=$classtoiniter;
				$datacour['vartoiniter']=$vartoiniter;
				$datacour['aliasiniter']=$aliasiniter;
				$datacour['outputaction']=$outputaction;
				
				$this->genesisdbfromfile->insert("chainuseconnector",$datacour);
			}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("connector"))
		{
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
				//load connector id
				$reqlib=$this->db->query("select * FROM `connector` WHERE `connector`.nomcodeconnector='".$nomcodeconnector."'");
				if($reslib=$this->db->fetch_array($reqlib))
					$idconnector=$reslib['idconnector'];
			}
			
			//insert chainuseconnector
			if(count($tabidchain)>0)
				foreach($tabidchain as $idchaincour)
				{
					$this->db->query("insert into `chainuseconnector` (idchainuseconnector,idchain,idconnector,ordre,classtoiniter,vartoiniter,aliasiniter,outputaction) VALUES (NULL,'".$idchaincour."','".$idconnector."','".$ordre."','".$classtoiniter."','".$vartoiniter."','".$aliasiniter."','".$outputaction."')");
				}
		}
		
		return true;
	}
	
	
	function delConnectorFromChain($nomcodeconnector="",$nomcodechain="all")
	{
		//TODO...prise en compte $nomcodechain
		
		//prepare data
		$nomcodeconnector=strtolower($nomcodeconnector);
		
		
		//dbfromfile
		if(is_numeric($nomcodeconnector))
		{
			//delete with id
			$reqconnector=$this->genesisdbfromfile->where("", "idconnector", $nomcodeconnector, "chainuseconnector");
			foreach($reqconnector as $resconnnector)
				$this->genesisdbfromfile->delete("chainuseconnector", $resconnnector['idchainuseconnector']);
		}
		else
		{
			//delete with codename
			$idconnector=$this->genesisdbfromfile->index("nomcodeconnector",$nomcodeconnector,"connector");
			
			$reqconnector=$this->genesisdbfromfile->where("", "idconnector", $idconnector, "chainuseconnector");
			foreach($reqconnector as $resconnnector)
				$this->genesisdbfromfile->delete("chainuseconnector", $resconnnector['idchainuseconnector']);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("connector"))
		{
			//delete
			$this->db->query("delete from `chainuseconnector` where (idconnector='".$nomcodeconnector."' or nomcodeconnector='".$nomcodeconnector."')");
		}
	}
	

}


?>