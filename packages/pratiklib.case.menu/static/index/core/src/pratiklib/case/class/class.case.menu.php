<?php

class CaseMenu extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function menu_loader($menuname,$menutpl="")
	{
		$menucour="";
		
		if($this->includer->include_pratikclass("menu"))
		{
			$instanceMenu=new PratikMenu($this->initer);
			$menucour=$instanceMenu->menu_loader($menuname,$menutpl);
		}
		
		return $menucour;
	}


}


?>