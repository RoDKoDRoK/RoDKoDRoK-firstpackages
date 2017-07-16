<?php

class PratikParams extends ClassIniter
{
	
	function __construct($initer)
	{
		//construct
		parent::__construct($initer);
		
	}
	
	
	function getParams($idelmt,$typeelmt)
	{
		$params=array();
		
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
		//test data exists
		$sql="select * from `param` where nomcodeparam='".$paramcodename."'";
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
		}
		
		//prepare data
		if(!is_numeric($idelmt))
		{
			$sql="select * from `".$typeelmt."` where nomcode".$typeelmt."='".$idelmt."'";
			$req=$this->db->query($sql);
			if($res=$this->db->fetch_array($req))
				$idelmt=$res['id'.$typeelmt];
		}
		
		//test data exists
		$sql="select * from `elmt_has_param` where idparam='".$idparam."'";
		$req=$this->db->query($sql);
		if($res=$this->db->fetch_array($req))
		{
			$tabparams=array();
			
			$tabelmthasparam=array();
			$tabelmthasparam['idelmt']=$idelmt;
			$tabelmthasparam['typeelmt']=$typeelmt;
			
			$this->updateParam($idparam,$tabparams,$tabelmthasparam);
		}
		else
		{
			//insert elmt_has_param
			$sql="INSERT INTO `elmt_has_param` VALUES (NULL,'".$idelmt."','','".$typeelmt."','".$idparam."')";
			$this->db->query($sql);
		}
		
	}
	
	
	function updateParam($idparam,$tabparams=array(),$tabelmthasparam=array())
	{
		//prepare data
		if(!is_numeric($idparam))
		{
			$sql="select * from `param` where nomcodeparam='".$idparam."'";
			$req=$this->db->query($sql);
			if($res=$this->db->fetch_array($req))
				$idparam=$res['idparam'];
		}
		
		
		//preapre data param
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
		
		
		//preapre data elmt_has_param
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
	
	
	function delParam($idparam)
	{
		//prepare data
		if(!is_numeric($idparam))
		{
			$sql="select * from `param` where nomcodeparam='".$idparam."'";
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
	
}



?>