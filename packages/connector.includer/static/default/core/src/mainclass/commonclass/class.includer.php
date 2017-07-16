<?php

class Includer
{
	var $instanceConf;
	var $conf;
	
	function __construct($instanceConf)
	{
		$this->instanceConf=$instanceConf;
		$this->conf=$instanceConf->conf;
	}
	
	function include_dbtableclass($dbtableclassname="example")
	{
		$dbtableclassname=strtolower($dbtableclassname);
		$dbtableclassnamefirstlettermaj=ucfirst($dbtableclassname);
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
		$pratikclassnamefirstlettermaj=ucfirst($pratikclassname);
		if(file_exists("core/src/pratikclass/class.".$pratikclassname.".php"))
		{
			include_once "core/src/pratikclass/class.".$pratikclassname.".php";
			return true;
		}
		return false;
	}
	
	
	function include_otherclass($chain,$otherclassname="example")
	{
		$otherclassname=strtolower($otherclassname);
		$otherclassnamefirstlettermaj=ucfirst($otherclassname);
		
		$tabclasspath=$this->instanceConf->get("classpath".$chain);
		if($tabclasspath)
			foreach($tabclasspath as $pathcour)
			{
				if(file_exists($pathcour."/class.".$otherclassname.".php"))
				{
					include_once $pathcour."/class.".$otherclassname.".php";
					return true;
				}
			}
		
		return false;
	}
	
	
}



?>