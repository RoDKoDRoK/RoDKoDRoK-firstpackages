<?php

class PratikPager extends ClassIniter
{
	var $lienpage="";
	var $nbelmtparpage=50;
	
	var $pagecour=0;
	
	function __construct($initer)
	{
		//construct
		parent::__construct($initer);
		
		//default lienpage
		$tabget=$_GET;
		$lienpage="?";
		foreach($tabget as $getid=>$getvalue)
			if($getid!="pagecour")
				$lienpage.=$getid."=".$getvalue."&";
		$this->lienpage=$lienpage."pagecour=";
		
		//pagecour
		$tmppagecour=$this->instanceVar->varget("pagecour");
		if($tmppagecour!="")
			$this->pagecour=$tmppagecour;
	}
	
	
	function getSqlLimit($req="")
	{
		$limit="";
		
		$limit.=$req;
		$limit.=" limit ";
		$limit.=($this->pagecour*$this->nbelmtparpage);
		$limit.=",";
		$limit.=$this->nbelmtparpage;
		
		return $limit;
	}
	
	
	function getPager($nbtotalelmt,$nbelmtparpage="",$lienpage="")
	{	
		//prepare nbelmtparpage
		if($nbelmtparpage=="")
			$nbelmtparpage=$this->nbelmtparpage;
		
		//prepare nbpage
		$nbpage=ceil($nbtotalelmt/$this->nbelmtparpage);
		
		//prepare lien
		if($lienpage=="")
			$lienpage=$this->lienpage;
	
		$start=$this->pagecour-10;
		$stop=$this->pagecour+10;
		
		$html="";
		$html.="<div class='pager'>";
		if($start<=1)
		{
			$start=0;
		}
		else
		{
			$html.=" <a href='".$lienpage."0'>&lt;&lt;</a> ...";
		}
		
		for($i=$start;$i<$stop && $i<$nbpage;$i++)
		{
			$html.=" <span";
			if($i==$this->pagecour)
				$html.=" class='pagecour'";
			$html.="><a ";
			$html.="href='".$lienpage.$i."'>".($i+1)."</a></span>";
		}
		
		if($stop<$nbpage)
		{
			$html.="... <a href='".$lienpage.($nbpage-1)."'>&gt;&gt;</a> ";
		}
		$html.="</div>";
		
		
		return $html;
	}


	
	
	
}



?>