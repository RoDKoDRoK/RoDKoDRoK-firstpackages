<?php

class Droit
{
	var $droitselected=null;
	
	
	function __construct($conf,$log,$db=null)
	{
		//select moteur droit
		$moteurlowercase="";
		if(isset($conf['moteurdroit']))
			$moteurlowercase=strtolower($conf['moteurdroit']);
		$moteurclass=ucfirst($moteurlowercase);
		if(file_exists("core/integrate/driver/class.access.".$moteurlowercase.".php"))
		{
			include_once "core/integrate/driver/class.access.".$moteurlowercase.".php";
			eval("\$this->droitselected=new Access".$moteurclass."(\$conf,\$db);");
		}
		else
		{
			include_once "core/integrate/driver/class.access.nodroit.php";
			$this->droitselected=new AccessNodroit($conf,$db);
			$log->pushtolog("Echec du chargement du driver access. Verifier la configuration ou votre driver.");
		}
	}
	
}



?>