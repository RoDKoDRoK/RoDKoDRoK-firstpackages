<?php

class PratikCodesrc extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	}
	
	
	
	function addCodeSrc($nomcodecodesrc,$nomcodesrc="",$description="",$typecodesrc="phpclass")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		
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
		
		return $idcodesrc;
	}
	
	
	function updateCodeSrc($nomcodecodesrc,$tabupdate=array())
	{
		if(is_array($tabupdate) && count($tabupdate)==0)
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
			
			//load task id
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
	
	
	function delCodeSrc($nomcodecodesrc="")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		
		//delete
		$this->db->query("delete from `codesrc` where (idcodesrc='".$nomcodecodesrc."' or nomcodecodesrc='".$nomcodecodesrc."')");
	}
	
	
	function addCodeSrcToChain($nomcodecodesrc,$tabnomcodechain="all",$cptconnectorcall="1",$ordre="0",$actif="1")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		
		$tabnomcodechain;
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
			$reqchain=$this->db->query("select * FROM `chain` WHERE `chain`.nomcodechain='".$nomcodechaincour."'");
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
		if(count($tabidchain)>0)
			foreach($tabidchain as $idchaincour)
			{
				//chack doublons avant insert
				$reqlib=$this->db->query("select * FROM `chainloadcodesrc` WHERE `chainloadcodesrc`.idcodesrc='".$idcodesrc."' and `chainloadcodesrc`.idchain='".$idchaincour."' and `chainloadcodesrc`.cptconnectorcall='".$cptconnectorcall."'");
				if($reslib=$this->db->fetch_array($reqlib))
					continue;
				
				//cas ordre
				$sqlordre="";
				if($ordre!="")
					$sqlordre=" and ordre='".$ordre."'";
				else
				{
					$ordre="0";
					$req=$this->db->query("select max(ordre) as maxordre FROM `chainloadcodesrc` WHERE idchain='".$idchain."' and cptconnectorcall='".$cptconnectorcall."';");
					if($res=$this->db->fetch_array($req))
						$ordre=$res['maxordre']+1;
				}
				
				//insert
				$this->db->query("INSERT INTO `chainloadcodesrc` (idchainloadcodesrc,idcodesrc,idchain,cptconnectorcall,ordre,actif) VALUES (NULL,'".$idcodesrc."','".$idchaincour."','".$cptconnectorcall."','".$ordre."','".$actif."');");
			}
		
		return true;
	}
	
	
	function delCodeSrcFromChain($nomcodecodesrc,$nomcodechain,$ordre="")
	{
		//prepare data
		$nomcodecodesrc=strtolower($nomcodecodesrc);
		$nomcodechain=strtolower($nomcodechain);
		
		//cas ordre
		$sqlordre="";
		if($ordre!="")
			$sqlordre=" and ordre='".$ordre."'";
		
		//delete
		$this->db->query("delete from `chainloadcodesrc` where idchain='".$idchain."' and idcodesrc='".$idcodesrc."' ".$sqlordre.";");
	}
	
}



?>