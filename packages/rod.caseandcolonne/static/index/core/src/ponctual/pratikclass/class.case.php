<?php

class PratikCase extends ClassIniter
{
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function case_loader($casename,$param=array())
	{
		$builtcase="";
		
		//get data cases
		//$req=$this->db->query("select * from `case`,`elmt_has_droit`,`droit` where `case`.nomcase='".$casename."' and `case`.idcase=`elmt_has_droit`.idelmt and `elmt_has_droit`.typeelmt='case' and `elmt_has_droit`.iddroit=`droit`.iddroit and `droit`.nomcodedroit='".$this->droit."'");
		$req=$this->db->query("select * from `case`,`instancecase` where `case`.idcase=`instancecase`.idcase and `instancecase`.nomcodeinstancecase='".$casename."'");
		if($req)
		{
			if($res=$this->db->fetch_array($req))
			{
				//test droit
				if(!$this->instanceDroit->hasAccessTo($res['nomcodecase'],"case"))
					return $builtcase;
				if(!$this->instanceDroit->hasAccessTo($res['nomcodeinstancecase'],"instancecase"))
					return $builtcase;
				
				//load params from db with pratik.params
				if(isset($this->includer) && $this->includer->include_pratikclass("Params"))
				{
					$instanceParams=new PratikParams($this->initer);
					$paramscasefromdb=$instanceParams->getParams($res['nomcodecase'],"case");
					$paramsinstancecasefromdb=$instanceParams->getParams($res['nomcodeinstancecase'],"instancecase");
					$param=array_merge($param,$paramscasefromdb,$paramsinstancecasefromdb);
				}
				
				
				//construct case courante
				$instanceTpl=new Tp($this->conf,$this->log);
				$this->initer['tplcase']=$instanceTpl->tpselected;
				$this->reloadIniter();
				
				//load arkitect data
				$this->tplcase->remplir_template("arkitectoutput",$this->arkitectoutput);
				
				//load css and js for case
				$this->tplcase->remplir_template("css",$this->getCssCase($res['nomcodecase']));
				$this->tplcase->remplir_template("js",$this->getJsCase($res['nomcodecase']));
				
				//load subtpl case
				$this->tplcase->remplir_template("case",$res['nomcodecase']);
				
				//load params
				$this->tplcase->remplir_template("param",$param);
				
				//load content case
				if(file_exists($this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.class")."/class.case.".$res['nomcodecase'].".php"))
					include_once $this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.class")."/class.case.".$res['nomcodecase'].".php";
				include $this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.loader")."/case.".$res['nomcodecase'].".php";
				
				//get case
				$builtcase.=$this->tplcase->get_template($this->arkitect->get("pratiklib.case")."/case.tpl");
			}
		}
		
		return $builtcase;
	}
	
	
	//get css and js
	function getCssCase($nomcodecase="")
	{
		$css="";
		
		if(file_exists($this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.css")."/case.".$nomcodecase.".css"))
			$css.="<link rel=\"stylesheet\" href=\"".$this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.css")."/case.".$nomcodecase.".css\" type=\"text/css\" />\n";
		
		//surcharge de la css possible dans le design
		if(file_exists("core/design/pratik/case/case.".$nomcodecase.".css"))
			$css.="<link rel=\"stylesheet\" href=\"core/design/pratik/case/case.".$nomcodecase.".css\" type=\"text/css\" />\n";
		
		return $css;
	}
	
	function getJsCase($nomcodecase="")
	{
		$js="";
		
		if(file_exists($this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.js")."/case.".$nomcodecase.".js"))
			$js.="<script src=\"".$this->arkitect->get("pratiklib.case").$this->arkitect->get("ext.pratikcase.js")."/case.".$nomcodecase.".js\"></script>\n";
		
		return $js;
	}
	
	
	
	//gestion des cases
	function addCase($nomcodecase,$nomcase="",$description="")
	{
		$this->db->query("INSERT INTO `case` VALUES (NULL,'".$nomcodecase."','".$nomcase."','".$description."');");
	}
	
	
	function updateCase($nomcodecase="",$tabupdatedata=array())
	{
		$id=0;
		if(is_numeric($nomcodecase))
		{
			$id=$nomcodecase;
		}
		else
		{
			$req=$this->db->query("select idcase FROM `case` WHERE nomcodecase='".$nomcodecase."'");
			if($req)
			{
				$res=$req->db->fetch_array($req);
				$id=$res['idcase'];
			}
		}
		
		$updatedata="";
		foreach($tabupdatedata as $iddatacour=>$valuedatacour)
		{
			$updatedata.=$iddatacour."='".$valuedatacour."', ";
		}
		$updatedata=substr($updatedata,0,-2);
	
		$this->db->query("UPDATE `case` SET ".$updatedata." WHERE idcase='".$id."'");
	}
	
	
	function deleteCase($nomcodecase="")
	{
		$id=0;
		if(is_numeric($nomcodecase))
		{
			$id=$nomcodecase;
		}
		else
		{
			$req=$this->db->query("select idcase FROM `case` WHERE nomcodecase='".$nomcodecase."'");
			if($req)
			{
				$res=$req->db->fetch_array($req);
				$id=$res['idcase'];
			}
		}
		$this->db->query("DELETE FROM `case` WHERE idcase='".$id."' or nomcodecase='".$nomcodecase."'");
		$this->db->query("DELETE FROM `colonne_has_case` WHERE idcase='".$id."'");
	}

}


?>