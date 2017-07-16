<?php

class Includer
{
	var $conf;
	
	function __construct($conf)
	{	
		$this->conf=$conf;
	}
	
	function include_dbtableclass($dbtableclassname="example")
	{
		$dbtableclassname=strtolower($dbtableclassname);
		if(file_exists("core/src/dbtableclass/class.".$dbtableclassname.".php"))
		{
			include_once "core/src/dbtableclass/class.".$dbtableclassname.".php";
			return true;
		}
		return false;
	}
	
	
	function include_pratikclass($pratikclassname="example")
	{
		$pratikclassname=strtolower($pratikclassname);
		if(file_exists("core/src/pratikclass/class.".$pratikclassname.".php"))
		{
			include_once "core/src/pratikclass/class.".$pratikclassname.".php";
			return true;
		}
		return false;
	}
	
}



?>