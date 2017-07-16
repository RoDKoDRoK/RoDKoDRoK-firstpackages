<?php

class PratikSearch extends ClassIniter
{
	var $tablestosearch="";
	
	var $searchcour="";
	
	function __construct($initer,$tablestosearch=array())
	{
		//construct
		parent::__construct($initer);
		
		$this->tablestosearch=$this->conf['defaultsearchtable'];
		if($tablestosearch!="" && $tablestosearch!=array())
			$this->tablestosearch=$tablestosearch;
		
		//searchcour
		$this->searchcour=trim($this->instanceVar->varget("pratiksearch"));
		$tmpsearchcourpost=trim($this->instanceVar->varpost("pratiksearch"));
		if($tmpsearchcourpost!="")
		{
			$this->searchcour=trim($tmpsearchcourpost);
			$_GET['pratiksearch']=$this->searchcour;
		}
		
	}
	
	
	function getSqlWhere($verysimplereq="")
	{
		$where="";
		
		if($this->searchcour=="")
			return $verysimplereq;
		
		//cas order by déjà présent
		$orderby=strstr(strtolower($verysimplereq)," order ");
		if($orderby)
		{
			$beforeorderby=strstr(strtolower($verysimplereq)," order ",true);
			$where.=$beforeorderby." ";
		}
		else
			$where.=$verysimplereq;
		
		//suite where
		if($verysimplereq=="" || strstr(strtolower($verysimplereq),"where"))
			$where.=" and ";
		else
			$where.=" where ";
		$where.="(";
		
		if(!is_array($this->tablestosearch))
		{
			$tmptabletosearch=$this->tablestosearch;
			$this->tablestosearch=array();
			$this->tablestosearch[0]=$tmptabletosearch;
		}
		
		foreach($this->tablestosearch as $tabletosearch)
		{
			$sqlcolumn="SELECT column_name,column_type 
							FROM information_schema.columns 
							WHERE table_schema = DATABASE() 
							AND table_name='".$tabletosearch."' 
							ORDER BY ordinal_position;";
			$req=$this->db->query($sqlcolumn);
			while($res=$this->db->fetch_array($req))
			{
				$where.=$tabletosearch.".".$res['column_name'];
				$where.=" like '%";
				$where.=str_replace("'","''",$this->searchcour);
				$where.="%' or ";
			}
		}
		
		$where=substr($where,0,-3);
		$where.=") ";
		
		if($orderby)
			$where.=$orderby;
		
		return $where;
	}
	
	
	function getSearchForm($searchlabel="Rechercher : ",$searchbutton="OK")
	{	
		$html="";
		$html.="<div class='search'>";
		
		$html.="<form method='post'>";
		$html.=$searchlabel;
		$html.="<input type='text' name='pratiksearch' value='".$this->searchcour."' />";
		$html.="<input type='submit' name='submitpratiksearch' value='".$searchbutton."' />";
		$html.="</form>";
		
		$html.="</div>";
		
		
		return $html;
	}


	
	
	
}



?>