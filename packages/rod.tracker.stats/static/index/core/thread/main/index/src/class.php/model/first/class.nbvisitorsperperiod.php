<?php

class NbVisitorsPerPeriod extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader()
	{
		$content="";
		
		$content.=$this->instanceLang->getTranslation("Nb visitors per period");
		$content.="<br />";
		$content.="<br />";
		$content.=$this->instanceLang->getTranslation("En construction...");
		
		return $content;
	}
	
	function graph_loader()
	{
		$graph="";
		
		//graph
		$graph.="<div id='maingraph'>Chargement</div>";
		
		//créer tab data
		$graph.="<script>";
		$graph.="var data=new Array();";
		
		$req=$this->db->query("select * from `tracker` where date>='".date("Y-m-d",strtotime("-1 month"))."'");
		while($res=$this->db->fetch_array($req))
		{
			$graph.="data.push({});";
		}
		
		$graph.="</script>";
		
		//générer graph
		$graph.="<script>generateGraph('maingraph',data);</script>";
		
		return $graph;
	}
	
	
}


?>