<?php

class Usertoken
{
	var $usertokenselected=null;
	
	
	function __construct($conf,$log,$db=null)
	{
		//select moteur droit
		$moteurlowercase="";
		if(isset($conf['moteurusertoken']))
			$moteurlowercase=strtolower($conf['moteurusertoken']);
		$moteurclass=ucfirst($moteurlowercase);
		if(file_exists("core/integrate/driver/class.token.".$moteurlowercase.".php"))
		{
			include_once "core/integrate/driver/class.token.".$moteurlowercase.".php";
			eval("\$this->usertokenselected=new Token".$moteurclass."(\$conf,\$db);");
		}
		else
		{
			include_once "core/integrate/driver/class.token.notoken.php";
			$this->usertokenselected=new TokenNotoken($conf,$db);
			$log->pushtolog("Echec du chargement du driver token (usertoken). Verifier la configuration ou votre driver.");
		}
	}
	
}



?>