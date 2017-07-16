<?php

class PratikColonne extends ClassIniter
{	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function colonne_loader($colonnename,$param=array())
	{
		$builtcase="";
		
		$pratikcase=new PratikCase($this->initer);
		
		//get data cases de la colonne
		//$req=$this->db->query("select * from `colonne`,`colonne_has_case`,`case`,`elmt_has_droit`,`droit` where `colonne`.nomcolonne='".$colonnename."' and `colonne`.idcolonne=`colonne_has_case`.idcolonne and `case`.idcase=`colonne_has_case`.idcase and `case`.idcase=`elmt_has_droit`.idelmt and `elmt_has_droit`.typeelmt='case' and `elmt_has_droit`.iddroit=`droit`.iddroit and `droit`.nomcodedroit='".$this->droit."'");
		$req=$this->db->query("select * from `colonne`,`colonne_has_case`,`case` where `colonne`.nomcolonne='".$colonnename."' and `colonne`.idcolonne=`colonne_has_case`.idcolonne and `case`.idcase=`colonne_has_case`.idcase order by `colonne_has_case`.ordre asc");
		if($req)
		{
			//test droit case
			if(!$this->instanceDroit->hasAccessTo($colonnename,"colonne"))
				return $builtcase;
			
			while($res=$this->db->fetch_array($req))
			{
				//test droit case
				if(!$this->instanceDroit->hasAccessTo($res['nomcodecase'],"case"))
					continue;
					
				//construct case courante
				$instanceTpl=new Tp($this->conf,$this->log);
				$this->initer['tplcase']=$instanceTpl->tpselected;
				$this->reloadIniter();
				
				//load css and js for case
				$this->tplcase->remplir_template("css",$pratikcase->getCssCase($res['nomcodecase']));
				$this->tplcase->remplir_template("js",$pratikcase->getJsCase($res['nomcodecase']));
				
				//load subtpl case
				$this->tplcase->remplir_template("case",$res['nomcodecase']);
				
				//load content case
				if(file_exists("core/src/pratiklib/case/class/class.case.".$res['nomcodecase'].".php"))
					include_once "core/src/pratiklib/case/class/class.case.".$res['nomcodecase'].".php";
				include_once "core/src/pratiklib/case/loader/case.".$res['nomcodecase'].".php";
				
				//get case
				$builtcase.=$this->tplcase->get_template("core/src/pratiklib/case/case.tpl");
			}
		}
		
		return $builtcase;
	}
	
	
	function addColonne($nomcodecolonne,$nomcolonne="",$description="")
	{
		$this->db->query("INSERT INTO `colonne` VALUES (NULL,'".$nomcodecolonne."','".$nomcolonne."','".$description."');");
	}
	
	function addCaseToColonne($nomcodecase,$nomcodecolonne,$ordre="0")
	{
		$idcolonne=0;
		if(is_numeric($nomcodecolonne))
		{
			$idcolonne=$nomcodecolonne;
		}
		else
		{
			$req=$this->db->query("select idcolonne FROM `colonne` WHERE nomcodecolonne='".$nomcodecolonne."'");
			if($req)
			{
				$res=$req->db->fetch_array($req);
				$idcolonne=$res['idcolonne'];
			}
		}
		
		$idcase=0;
		if(is_numeric($nomcodecase))
		{
			$idcase=$nomcodecase;
		}
		else
		{
			$req=$this->db->query("select idcase FROM `case` WHERE nomcodecase='".$nomcodecase."'");
			if($req)
			{
				$res=$req->db->fetch_array($req);
				$idcase=$res['idcase'];
			}
		}
		
		$this->db->query("INSERT INTO `colonne_has_case` VALUES ('".$idcolonne."','".$idcase."','".$ordre."');");
	}
	
	
	function updateColonne($nomcodecolonne="",$tabupdatedata=array())
	{
		$id=0;
		if(is_numeric($nomcodecolonne))
		{
			$id=$nomcodecolonne;
		}
		else
		{
			$req=$this->db->query("select idcolonne FROM `colonne` WHERE nomcodecolonne='".$nomcodecolonne."'");
			if($req)
			{
				$res=$req->db->fetch_array($req);
				$id=$res['idcolonne'];
			}
		}
		
		$updatedata="";
		foreach($tabupdatedata as $iddatacour=>$valuedatacour)
		{
			$updatedata.=$iddatacour."='".$valuedatacour."', ";
		}
		$updatedata=substr($updatedata,0,-2);
	
		$this->db->query("UPDATE `colonne` SET ".$updatedata." WHERE idcolonne='".$id."'");
	}
	
	
	function deleteColonne($nomcodecolonne="")
	{
		$id=0;
		if(is_numeric($nomcodecolonne))
		{
			$id=$nomcodecolonne;
		}
		else
		{
			$req=$this->db->query("select idcolonne FROM `colonne` WHERE nomcodecolonne='".$nomcodecolonne."'");
			if($req)
			{
				$res=$req->db->fetch_array($req);
				$id=$res['idcolonne'];
			}
		}
		$this->db->query("DELETE FROM `colonne` WHERE idcolonne='".$id."' or nomcodecolonne='".$nomcodecolonne."'");
		$this->db->query("DELETE FROM `colonne_has_case` WHERE idcolonne='".$id."'");
	}

}


?>