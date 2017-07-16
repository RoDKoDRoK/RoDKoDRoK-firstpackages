<?php

class PratikMenu extends ClassIniter
{	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function menu_loader($menuname,$menutpl="")
	{
		$tabmenu=array();
		
		//set tpl
		if($menutpl=="")
			$menutpl=$menuname;
		
		//get data menu
		//$req=$this->db->query("select * from `menu`,`elmt_has_droit`,`droit` where `menu`.zone='".$menuname."' and `menu`.idmenu=`elmt_has_droit`.idelmt and `elmt_has_droit`.typeelmt='menu' and `elmt_has_droit`.iddroit=`droit`.iddroit and `droit`.nomcodedroit='".$this->droit."'");
		$req=$this->db->query("select * from `menu` where `menu`.zone='".$menuname."' order by ordre asc");
		if($req)
		{
			while($res=$this->db->fetch_array($req))
			{
				//test droit
				if(!$this->instanceDroit->hasAccessTo($res['nomcodemenu'],"menu"))
					continue;
					
				$tabmenu[]=$res;
				
				$tabmenu[count($tabmenu)-1]['ssmenu']=array();
				$ssreq=$this->db->query("select * from `menu`, `menu_has_ssmenu` where idmenu='".$res['idmenu']."' and `menu`.idmenu=`menu_has_ssmenu`.idssmenu");
				if($ssreq)
				{
					while($ssres=$this->db->fetch_array($ssreq))
					{
						//test droit
						if(!$this->instanceDroit->hasAccessTo($ssres['nomcodemenu'],"menu"))
							continue;
					
						$tabmenu[count($tabmenu)-1]['ssmenu'][]=$ssres;
					}
				}
			}
		}
		
		//construct menu
		$instanceTpl=new Tp($this->conf,$this->log);
		$tpl=$instanceTpl->tpselected;
		
		//load menu tpl
		$tpl->remplir_template("menu",$menutpl);
		
		//load css and js
		$tpl->remplir_template("css",$this->getCssMenu($menutpl));
		$tpl->remplir_template("js",$this->getJsMenu($menutpl));
		
		//load data menu
		$tpl->remplir_template("data",$tabmenu);
		
		$builtmenu=$tpl->get_template("core/src/pratiklib/menu/menu.tpl");
		
		return $builtmenu;
	}
	
	
	
	//get css and js
	function getCssMenu($nommenutpl="")
	{
		$css="";
		
		if(file_exists("core/src/pratiklib/menu/css/menu.".$nommenutpl.".css"))
			$css.="<link rel=\"stylesheet\" href=\"core/src/pratiklib/menu/css/menu.".$nommenutpl.".css\" type=\"text/css\" />\n";
		
		//surcharge de la css possible dans le design
		if(file_exists("core/design/pratik/menu/menu.".$nommenutpl.".css"))
			$css.="<link rel=\"stylesheet\" href=\"core/design/pratik/menu/menu.".$nommenutpl.".css\" type=\"text/css\" />\n";
		
		return $css;
	}
	
	function getJsMenu($nommenutpl="")
	{
		$js="";
		
		if(file_exists("core/src/pratiklib/menu/js/menu.".$nommenutpl.".js"))
			$js.="<script src=\"core/src/pratiklib/menu/js/menu.".$nommenutpl.".js\"></script>\n";
		
		return $js;
	}
	
	
	
	//gestion des menus
	function addMenu($nomcodemenu,$zone,$titre,$lien,$description="",$lang="fr_fr",$ordre="0")
	{
		//check doublons
		$req=$this->db->query("select idmenu FROM `menu` WHERE nomcodemenu='".$nomcodemenu."'");
		if($req)
		{
			$res=$this->db->fetch_array($req);
			if($res)
				return true;
		}
		
		//insert
		$this->db->query("INSERT INTO `menu` VALUES (NULL,'".$nomcodemenu."','".$zone."','".$titre."','".$lien."','".$description."','".$lang."','".$ordre."');");
		
		return true;
	}
	
	
	function updateMenu($nomcodemenu="",$tabupdatedata=array())
	{
		$id=0;
		if(is_numeric($nomcodemenu))
		{
			$id=$nomcodemenu;
		}
		else
		{
			$req=$this->db->query("select idmenu FROM `menu` WHERE nomcodemenu='".$nomcodemenu."'");
			if($req)
			{
				$res=$this->db->fetch_array($req);
				$id=$res['idmenu'];
			}
		}
		
		$updatedata="";
		foreach($tabupdatedata as $iddatacour=>$valuedatacour)
		{
			$updatedata.=$iddatacour."='".$valuedatacour."', ";
		}
		$updatedata=substr($updatedata,0,-2);
	
		$this->db->query("UPDATE `menu` SET ".$updatedata." WHERE idmenu='".$id."'");
	}
	
	
	function deleteMenu($nomcodemenu="")
	{
		$id=0;
		if(is_numeric($nomcodemenu))
		{
			$id=$nomcodemenu;
		}
		else
		{
			$req=$this->db->query("select idmenu FROM `menu` WHERE nomcodemenu='".$nomcodemenu."'");
			if($req)
			{
				$res=$this->db->fetch_array($req);
				$id=$res['idmenu'];
			}
		}
		$this->db->query("DELETE FROM `menu` WHERE idmenu='".$id."' or nomcodemenu='".$nomcodemenu."'");
		$this->db->query("DELETE FROM `menu_has_ssmenu` WHERE idmenu='".$id."' or idssmenu='".$id."'");
	}


}


?>