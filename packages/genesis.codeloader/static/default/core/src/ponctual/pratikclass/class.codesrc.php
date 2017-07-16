<?php

class PratikCodesrc extends ClassIniter
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
	
	
	function addCodeSrc($nomcodecodesrc,$nomcodesrc="",$description="",$typecodesrc="phpclass")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		
		
		//dbfromfile
		$datacour=array();
		$datacour['idcodesrc']=$this->genesisdbfromfile->max("idcodesrc","codesrc");
		$datacour['idcodesrc']++;
		$datacour['nomcodecodesrc']=$nomcodecodesrc;
		$datacour['nomcodesrc']=$nomcodesrc;
		$datacour['description']=$description;
		$datacour['typecodesrc']=$typecodesrc;
		
		
		//check codesrc already exists
		$idcodesrc=$nomcodecodesrc;
		if(!is_numeric($idcodesrc))
			$idcodesrc=$this->genesisdbfromfile->index("nomcodecodesrc",$nomcodecodesrc,"codesrc");
		if($idcodesrc!="0")
		{
			//update not used
			/*
			$tabdata=array();
			$tabdata['nomcodecodesrc']=$nomcodecodesrc;
			$tabdata['nomcodesrc']=$nomcodesrc;
			$tabdata['description']=$description;
			$tabdata['typecodesrc']=$typecodesrc;
			
			$this->updateCodeSrc($idcodesrc,$tabdata);
			*/
		}
		else
		{
			$this->genesisdbfromfile->insert("codesrc",$datacour);
			$idcodesrc=$datacour['idcodesrc'];
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("codesrc"))
		{
			//check codesrc already exists
			$reqexists=$this->db->query("select * FROM `codesrc` WHERE `codesrc`.nomcodecodesrc='".$nomcodecodesrc."' or `codesrc`.idcodesrc='".$nomcodecodesrc."'");
			if($resexists=$this->db->fetch_array($reqexists))
			{
				$idcodesrc=$resexists['idcodesrc'];
				//update not used
				/*$req=$this->db->query("update `codesrc` set 
											nomcodesrc='".$nomcodesrc."', 
											description='".$description."',
											typecodesrc='".$typecodesrc."'
										where idcodesrc='".$idcodesrc."'
										");
				*/
			}
			else
			{
				$this->db->query("insert into `codesrc` (idcodesrc,nomcodecodesrc,nomcodesrc,description,typecodesrc) values (NULL,'".$nomcodecodesrc."','".$nomcodesrc."','".$description."','".$typecodesrc."');");
				$idcodesrc=$this->db->last_insert_id();
			}
		}
		
		
		return $idcodesrc;
	}
	
	
	function updateCodeSrc($nomcodecodesrc,$tabupdate=array())
	{
		if(!is_array($tabupdate) || (is_array($tabupdate) && count($tabupdate)==0))
			return;
		
		//check idcodesrc to update
		$idcodesrc="0";
		if(is_numeric($nomcodecodesrc))
		{
			$idcodesrc=$nomcodecodesrc;
		}
		else
		{
			//prepare data
			$nomcodecodesrc=strtolower($nomcodecodesrc);
			
			//load codesrc id
			$idcodesrc=$this->genesisdbfromfile->index("nomcodecodesrc",$nomcodecodesrc,"codesrc");
		}
		
		//update
		//prepare data
		$datacour=$tabupdate;
		
		//update event
		$this->genesisdbfromfile->update("codesrc",$idcodesrc,$datacour);
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("codesrc"))
		{
			//check idcodesrc to update
			$idcodesrc="0";
			if(is_numeric($nomcodecodesrc))
			{
				$idcodesrc=$nomcodecodesrc;
			}
			else
			{
				//prepare data
				$nomcodecodesrc=strtolower($nomcodecodesrc);
				
				//load codesrc id
				$reqcodesrc=$this->db->query("select * FROM `codesrc` WHERE `codesrc`.nomcodecodesrc='".$nomcodecodesrc."'");
				if($rescodesrc=$this->db->fetch_array($reqcodesrc))
					$idcodesrc=$rescodesrc['idcodesrc'];
			}
			
			//prepare update
			$update="";
			foreach($tabupdate as $idtab=>$valuetab)
			{
				$update.=$idtab."='".$valuetab."' , ";
			}
			$update=substr($update,0,-2);
			
			//update
			$this->db->query("update `codesrc` set 
											".$update." 
										where idcodesrc='".$idcodesrc."'
										");
		}
	} 
	
	
	function delCodeSrc($nomcodecodesrc="")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		
		
		//dbfromfile
		if(is_numeric($nomcodecodesrc))
		{
			//delete with id
			$this->genesisdbfromfile->delete("codesrc", $nomcodecodesrc);
		}
		else
		{
			//delete with codename
			$index=$this->genesisdbfromfile->index("nomcodecodesrc",$nomcodecodesrc,"codesrc");
			$this->genesisdbfromfile->delete("codesrc", $index);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("codesrc"))
		{
			//delete
			$this->db->query("delete from `codesrc` where (idcodesrc='".$nomcodecodesrc."' or nomcodecodesrc='".$nomcodecodesrc."')");
		}
	}
	
	
	function addCodeSrcToChain($nomcodecodesrc,$tabnomcodechain="all",$cptconnectorcall="1",$ordre="",$actif="1")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		
		
		//dbfromfile
		$tabidchain=array();
		if($tabnomcodechain=="all")
		{
			$reschain=$this->genesisdbfromfile->select("nomcodechain","chain");
			foreach($reschain as $chaincour)
				$tabidchain[]=$this->genesisdbfromfile->index("nomcodechain",$chaincour['nomcodechain'],"chain");
			
		}
		else if(is_array($tabnomcodechain))
		{
			foreach($tabnomcodechain as $nomcodechaincour)
			{
				$tabidchain[]=$this->genesisdbfromfile->index("nomcodechain",$nomcodechaincour,"chain");
			}
		}
		else
		{
			$tabidchain[]=$this->genesisdbfromfile->index("nomcodechain",$tabnomcodechain,"chain");
		}
		
		
		//get idcodesrc
		$idcodesrc="0";
		if(is_numeric($nomcodecodesrc))
		{
			$idcodesrc=$nomcodecodesrc;
		}
		else
		{
			//prepare data
			$nomcodecodesrc=strtolower($nomcodecodesrc);
			
			//load codesrc id
			$idcodesrc=$this->genesisdbfromfile->index("nomcodecodesrc",$nomcodecodesrc,"codesrc");
		}
		
		//insert chainloadcodesrc
		$tabidchainloadcodesrc=array();
		if(count($tabidchain)>0)
			foreach($tabidchain as $idchaincour)
			{
				//check doublons avant insert
				$where=$this->genesisdbfromfile->where("","idcodesrc",$idcodesrc,"chainloadcodesrc");
				$where=$this->genesisdbfromfile->where("","idchain",$idchaincour,$where);
				$index=$this->genesisdbfromfile->index("cptconnectorcall",$cptconnectorcall,$where);
				if($index>0)
					continue;
				
				//cas ordre
				if(!is_numeric($ordre) || $ordre=="0" || $ordre=="")
				{
					$ordre="0";
					
					$where=$this->genesisdbfromfile->where("","cptconnectorcall",$cptconnectorcall,"chainloadcodesrc");
					$where=$this->genesisdbfromfile->where("","idchain",$idchaincour,$where);
					$max=$this->genesisdbfromfile->max("ordre",$where);
				
					if($max!==false)
						$ordre=$max+1;
				}
				
				//prepare data to insert
				$datacour=array();
				$datacour['idchainloadcodesrc']=$this->genesisdbfromfile->max("idchainloadcodesrc","chainloadcodesrc");
				$datacour['idchainloadcodesrc']++;
				$datacour['idcodesrc']=$idcodesrc;
				$datacour['idchain']=$idchaincour;
				$datacour['cptconnectorcall']=$cptconnectorcall;
				$datacour['ordre']=$ordre;
				$datacour['actif']=$actif;
		
				//insert
				$this->genesisdbfromfile->insert("chainloadcodesrc",$datacour);
				$tabidchainloadcodesrc[]=$datacour['idchainloadcodesrc']; //$this->genesisdbfromfile->count("","chainloadcodesrc");
				
			}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("codesrc"))
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
			
			
			//get idcodesrc
			$idcodesrc="0";
			if(is_numeric($nomcodecodesrc))
			{
				$idcodesrc=$nomcodecodesrc;
			}
			else
			{
				//prepare data
				$nomcodecodesrc=strtolower($nomcodecodesrc);
				
				//load codesrc id
				$reqcodesrc=$this->db->query("select * FROM `codesrc` WHERE `codesrc`.nomcodecodesrc='".$nomcodecodesrc."'");
				if($rescodesrc=$this->db->fetch_array($reqcodesrc))
					$idcodesrc=$rescodesrc['idcodesrc'];
			}
			
			//insert chainloadcodesrc
			$tabidchainloadcodesrc=array();
			if(count($tabidchain)>0)
				foreach($tabidchain as $idchaincour)
				{
					//chack doublons avant insert
					$reqlib=$this->db->query("select * FROM `chainloadcodesrc` WHERE `chainloadcodesrc`.idcodesrc='".$idcodesrc."' and `chainloadcodesrc`.idchain='".$idchaincour."' and `chainloadcodesrc`.cptconnectorcall='".$cptconnectorcall."'");
					if($reslib=$this->db->fetch_array($reqlib))
						continue;
					
					//cas ordre
					if(!is_numeric($ordre) || $ordre=="0" || $ordre=="")
					{
						$ordre="0";
						$req=$this->db->query("select max(ordre) as maxordre FROM `chainloadcodesrc` WHERE idchain='".$idchaincour."' and cptconnectorcall='".$cptconnectorcall."';");
						if($res=$this->db->fetch_array($req))
							$ordre=$res['maxordre']+1;
					}
					
					//insert
					$this->db->query("INSERT INTO `chainloadcodesrc` (idchainloadcodesrc,idcodesrc,idchain,cptconnectorcall,ordre,actif) VALUES (NULL,'".$idcodesrc."','".$idchaincour."','".$cptconnectorcall."','".$ordre."','".$actif."');");
					$tabidchainloadcodesrc[]=$this->db->last_insert_id();
				}
			
		}
		
		return $tabidchainloadcodesrc;
	}
	
	
	function delCodeSrcFromChain($nomcodecodesrc,$nomcodechain,$ordre="")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		$nomcodechain=strtolower($nomcodechain);
		
		
		//dbfromfile
		//cas ordre
		$sqlordre=false;
		if($ordre!="")
			$sqlordre=true;
		
		//delete
		$tabtmp=$this->genesisdbfromfile->where("", "idchain", $idchain, "chainloadcodesrc");
		if($sqlordre)
			$tabtmp=$this->genesisdbfromfile->where("", "ordre", $ordre, $tabtmp);
		$index=$this->genesisdbfromfile->index("idcodesrc",$idcodesrc,$tabtmp,"idchainloadcodesrc");
		$this->genesisdbfromfile->delete("chainloadcodesrc", $index);
		
	
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("codesrc"))
		{
			//cas ordre
			$sqlordre="";
			if($ordre!="")
				$sqlordre=" and ordre='".$ordre."'";
			
			//delete
			$this->db->query("delete from `chainloadcodesrc` where idchain='".$idchain."' and idcodesrc='".$idcodesrc."' ".$sqlordre.";");
		}
	}
	
}



?>