<?php

class CaseMenu extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function menu_loader($menuname)
	{
		$menucour="";
		
		if($this->includer->include_pratikclass("menu"))
		{
			$instanceMenu=new Menu($this->db,$this->lang,$this->droit);
			$menucour=$instanceMenu->menu_loader($menuname);
		}
		
		return $menucour;
	}


}


?>