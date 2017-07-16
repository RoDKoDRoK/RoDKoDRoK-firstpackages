<?php

class PratikParams extends ClassIniter
{
	
	function __construct($initer)
	{
		//construct
		parent::__construct($initer);
		
	}
	
	
	function getIniterPrerequis()
	{
		$prerequis=array();
		
		$prerequis[]="db";
		
		return $prerequis;
	}
	
	
	function getParams($idelmt,$typeelmt)
	{
		$params=array();
		
		//dbfromfile
		if($this->genesisdbfromfile->isTable($typeelmt))
		{
			//prepare data
			if(!is_numeric($idelmt))
			{
				$idelmt=$this->genesisdbfromfile->index("nomcode".$typeelmt,$idelmt,$typeelmt);
			}
			
			//select params
			$tabtmp=$this->genesisdbfromfile->join("inner", "", "param", "elmt_has_param", array("idparam"=>"idparam"));
			$tabtmp=$this->genesisdbfromfile->where("", "idelmt", $idelmt, $tabtmp);
			$tabtmp=$this->genesisdbfromfile->where("", "typeelmt", $typeelmt, $tabtmp);
			$tabtmp=$this->genesisdbfromfile->orderby("ordre", $tabtmp);
			$tabreq=$tabtmp;
			
			foreach($tabreq as $res)
			{
				$params[$res['nomcodeparam']]=$res['value'];
			}
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("param"))
		{
			//prepare data
			if(!is_numeric($idelmt))
			{
				$sql="select * from `".$typeelmt."` where nomcode".$typeelmt."='".$idelmt."'";
				$req=$this->db->query($sql);
				if($res=$this->db->fetch_array($req))
					$idelmt=$res['id'.$typeelmt];
			}
			
			//select params
			$sql="select * from `param`, `elmt_has_param` 
					where `param`.idparam=`elmt_has_param`.idparam and 
							`elmt_has_param`.idelmt='".$idelmt."' and 
							`elmt_has_param`.typeelmt='".$typeelmt."' 
					order by `param`.ordre";
			$req=$this->db->query($sql);
			while($res=$this->db->fetch_array($req))
			{
				$params[$res['nomcodeparam']]=$res['value'];
			}
		}
		
		return $params;
	}
	
	
	function getParamValue($idelmt,$typeelmt,$paramcodename)
	{
		$paramvalue="";
		
		$params=$this->getParams($idelmt,$typeelmt);
		
		if(isset($params[$paramcodename]))
			$paramvalue=$params[$paramcodename];
		
		return $paramvalue;
	}
	
	
	function addParam($idelmt,$typeelmt,$paramcodename,$paramvalue)
	{
		//dbfromfile
		if($this->genesisdbfromfile->isTable($typeelmt))
		{
			//prepare data
			if(!is_numeric($idelmt))
			{
				$idelmt=$this->genesisdbfromfile->index("nomcode".$typeelmt,$idelmt,$typeelmt);
			}
			
			//test data exists
			$tabtmp=$this->genesisdbfromfile->join("inner", "", "param", "elmt_has_param", array("idparam"=>"idparam"));
			$tabtmp=$this->genesisdbfromfile->where("", "nomcodeparam", $paramcodename, $tabtmp);
			$tabtmp=$this->genesisdbfromfile->where("", "idelmt", $idelmt, $tabtmp);
			$tabtmp=$this->genesisdbfromfile->where("", "typeelmt", $typeelmt, $tabtmp);
			$tabreq=$tabtmp;
			
			if(is_array($tabreq) && count($tabreq)>0)
			{
				foreach($tabreq as $res)
				{
					$idparam=$res['idparam'];
					
					$tabparams=array();
					$tabparams['nomcodeparam']=$paramcodename;
					$tabparams['value']=$paramvalue;
					
					$this->updateParam($idparam,$tabparams);
				}
			}
			else
			{
				//insert param
				$datacour=array();
				$datacour['idparam']=$this->genesisdbfromfile->max("idparam","param");
				$datacour['idparam']++;
				$datacour['nomcodeparam']=$paramcodename;
				$datacour['nomparam']=$paramcodename;
				$datacour['description']=$paramcodename;
				$datacour['value']=$paramvalue;
				$datacour['ordre']="0";
				
				$this->genesisdbfromfile->insert("param",$datacour);
				$idparam=$datacour['idparam']; //$this->genesisdbfromfile->count("","param");
				
				//insert elmt_has_param
				$datacour=array();
				$datacour['idelmt_has_param']=$this->genesisdbfromfile->max("idelmt_has_param","elmt_has_param");
				$datacour['idelmt_has_param']++;
				$datacour['idelmt']=$idelmt;
				$datacour['elmt']="";
				$datacour['typeelmt']=$typeelmt;
				$datacour['idparam']=$idparam;
				
				$this->genesisdbfromfile->insert("elmt_has_param",$datacour);
			}
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("param"))
		{
			//prepare data
			if(!is_numeric($idelmt))
			{
				$sql="select * from `".$typeelmt."` where nomcode".$typeelmt."='".$idelmt."'";
				$req=$this->db->query($sql);
				if($res=$this->db->fetch_array($req))
					$idelmt=$res['id'.$typeelmt];
			}
			
			//test data exists
			$sql="select * from `elmt_has_param`,`param` 
						where `elmt_has_param`.idparam=`param`.idparam and 
								`param`.nomcodeparam='".$paramcodename."' and 
								`elmt_has_param`.idelmt='".$idelmt."' and 
								`elmt_has_param`.typeelmt='".$typeelmt."'";
			$req=$this->db->query($sql);
			if($res=$this->db->fetch_array($req))
			{
				$idparam=$res['idparam'];
				
				$tabparams=array();
				$tabparams['nomcodeparam']=$paramcodename;
				$tabparams['value']=$paramvalue;
				
				$this->updateParam($idparam,$tabparams);
			}
			else
			{
				//insert param
				$sql="INSERT INTO `param` VALUES (NULL,'".$paramcodename."','".$paramcodename."','".$paramcodename."','".$paramvalue."','0')";
				$this->db->query($sql);
				$idparam=$this->db->last_insert_id();
				
				//insert elmt_has_param
				$sql="INSERT INTO `elmt_has_param` VALUES (NULL,'".$idelmt."','','".$typeelmt."','".$idparam."')";
				$this->db->query($sql);
			}
		}
		
	}
	
	
	function updateParam($idparam,$tabparams=array(),$tabelmthasparam=array(),$idelmt=null,$typeelmt=null)
	{
		//dbfromfile
		if($this->genesisdbfromfile->isTable($typeelmt))
		{
			//prepare data
			if(!is_numeric($idparam))
			{
				if($idelmt==null || $typeelmt==null)
					return false;
				
				//prepare data
				if(!is_numeric($idelmt))
				{
					$idelmt=$this->genesisdbfromfile->index("nomcode".$typeelmt,$idelmt,$typeelmt);
				}
				
				$tabtmp=$this->genesisdbfromfile->join("inner", "", "param", "elmt_has_param", array("idparam"=>"idparam"));
				$tabtmp=$this->genesisdbfromfile->where("", "nomcodeparam", $idparam, $tabtmp);
				$tabtmp=$this->genesisdbfromfile->where("", "idelmt", $idelmt, $tabtmp);
				$tabtmp=$this->genesisdbfromfile->where("", "typeelmt", $typeelmt, $tabtmp);
				$tabreq=$tabtmp;
				
				if(is_array($tabreq) && count($tabreq)>0)
				{
					foreach($tabreq as $res)
					{
						$idparam=$res['idparam'];
					}
				}
				
			}
		
		
			//update param
			if(is_array($tabparams) && count($tabparams)>0)
			{
				//prepare data param
				$datacour=$tabparams;
				
				//update param
				$index=$this->genesisdbfromfile->index("idparam",$idparam,"param");
				$this->genesisdbfromfile->update("param",$index,$datacour);
			}
			
			
			//update elmt_has_param
			if(is_array($tabelmthasparam) && count($tabelmthasparam)>0)
			{
				//prepare data elmt_has_param
				$datacour=$tabelmthasparam;
				
				//update elmt_has_param
				$index=$this->genesisdbfromfile->index("idparam",$idparam,"elmt_has_param");
				$this->genesisdbfromfile->update("elmt_has_param",$index,$datacour);
			}
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("param"))
		{
			//prepare data
			if(!is_numeric($idparam))
			{
				if($idelmt==null || $typeelmt==null)
					return false;
				
				//prepare data
				if(!is_numeric($idelmt))
				{
					$sql="select * from `".$typeelmt."` where nomcode".$typeelmt."='".$idelmt."'";
					$req=$this->db->query($sql);
					if($res=$this->db->fetch_array($req))
						$idelmt=$res['id'.$typeelmt];
				}
				
				
				$sql="select * from `elmt_has_param`,`param` 
						where `elmt_has_param`.idparam=`param`.idparam and 
								`param`.nomcodeparam='".$idparam."' and 
								`elmt_has_param`.idelmt='".$idelmt."' and 
								`elmt_has_param`.typeelmt='".$typeelmt."'";
				$req=$this->db->query($sql);
				if($res=$this->db->fetch_array($req))
					$idparam=$res['idparam'];
			}
			
			
			//prepare data param
			$updatecour="";
			foreach($tabparams as $idcour=>$valuecour)
				$updatecour.=$idcour."='".$valuecour."', ";
			if($updatecour!="")
			{
				$updatecour=substr($updatecour,0,-2);
			
				//update param
				$sql="UPDATE `param` SET 
							".$updatecour." 
						WHERE idparam='".$idparam."'";
				$this->db->query($sql);
			}
			
			
			//prepare data elmt_has_param
			$updatecour="";
			foreach($tabelmthasparam as $idcour=>$valuecour)
				$updatecour.=$idcour."='".$valuecour."', ";
			if($updatecour!="")
			{
				$updatecour=substr($updatecour,0,-2);
				
				//update elmt_has_param
				$sql="UPDATE `elmt_has_param` SET 
							".$updatecour." 
						WHERE idparam='".$idparam."'";
				$this->db->query($sql);
			}
		}
	}
	
	
	function delParam($idparam,$idelmt=null,$typeelmt=null)
	{
		//dbfromfile
		if($this->genesisdbfromfile->isTable($typeelmt))
		{
			//prepare data
			if(!is_numeric($idparam))
			{
				if($idelmt==null || $typeelmt==null)
					return false;
				
				//prepare data
				if(!is_numeric($idelmt))
				{
					$idelmt=$this->genesisdbfromfile->index($typeelmt,"nomcode".$typeelmt,$idelmt);
				}
				
				$tabtmp=$this->genesisdbfromfile->join("inner", "", "param", "elmt_has_param", array("idparam"=>"idparam"));
				$tabtmp=$this->genesisdbfromfile->where("", "nomcodeparam", $idparam, $tabtmp);
				$tabtmp=$this->genesisdbfromfile->where("", "idelmt", $idelmt, $tabtmp);
				$tabtmp=$this->genesisdbfromfile->where("", "typeelmt", $typeelmt, $tabtmp);
				$tabreq=$tabtmp;
				
				if(is_array($tabreq) && count($tabreq)>0)
				{
					foreach($tabreq as $res)
					{
						$idparam=$res['idparam'];
					}
				}
			}
		
			//delete elmt_has_param
			$index=$this->genesisdbfromfile->index("idparam",$idparam,"elmt_has_param");
			$this->genesisdbfromfile->delete("elmt_has_param", $index);
			
			//delete param
			$index=$this->genesisdbfromfile->index("idparam",$idparam,"param");
			$this->genesisdbfromfile->delete("param", $index);
		}
		
		
		//db
		if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("param"))
		{
			//prepare data
			if(!is_numeric($idparam))
			{
				if($idelmt==null || $typeelmt==null)
					return false;
				
				//prepare data
				if(!is_numeric($idelmt))
				{
					$sql="select * from `".$typeelmt."` where nomcode".$typeelmt."='".$idelmt."'";
					$req=$this->db->query($sql);
					if($res=$this->db->fetch_array($req))
						$idelmt=$res['id'.$typeelmt];
				}
				
				
				$sql="select * from `elmt_has_param`,`param` 
						where `elmt_has_param`.idparam=`param`.idparam and 
								`param`.nomcodeparam='".$idparam."' and 
								`elmt_has_param`.idelmt='".$idelmt."' and 
								`elmt_has_param`.typeelmt='".$typeelmt."'";
				$req=$this->db->query($sql);
				if($res=$this->db->fetch_array($req))
					$idparam=$res['idparam'];
			}
			
			//delete elmt_has_param
			$sql="DELETE FROM `elmt_has_param` WHERE idparam='".$idparam."'";
			$this->db->query($sql);
			
			//delete param
			$sql="DELETE FROM `param` WHERE idparam='".$idparam."'";
			$this->db->query($sql);
		}
		
		
		return true;
	}
	
}



?>