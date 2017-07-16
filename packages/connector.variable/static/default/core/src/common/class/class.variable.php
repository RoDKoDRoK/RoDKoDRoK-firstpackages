<?php

class Variable
{
	
	function __construct()
	{
		
	}
	
	
	function varget($vargetname="examplename")
	{
		if(isset($_GET[$vargetname]) && $_GET[$vargetname]!="")
			return $_GET[$vargetname];
		return "";
	}
	
	
	function varpost($varpostname="examplename")
	{
		if(isset($_POST[$varpostname]) && $_POST[$varpostname]!="")
			return $_POST[$varpostname];
		return "";
	}
	
	
	function varsession($varsessionname="examplename")
	{
		if(isset($_SESSION[$varsessionname]) && $_SESSION[$varsessionname]!="")
		{
			$sessionvalue=$_SESSION[$varsessionname];
			unset($_SESSION[$varsessionname]); //checker des variables de session à ne pas unsetter (user par exemple) à préciser dans un fichier de conf
			return $sessionvalue;
		}
		return "";
	}
	
	
	function vartotmpsession($var="",$varsessionname="tmp")
	{
		//set a tmp session var to get after a post form for example or to conserve data through a reload of a page
		if(isset($_SESSION[$varsessionname]))
		{
			$tmpcour=$_SESSION[$varsessionname];
			unset($_SESSION[$varsessionname]);
			return $tmpcour;
		}
		else
		{
			$_SESSION[$varsessionname]=$var;
			return $var;
		}
	}
	


}


?>