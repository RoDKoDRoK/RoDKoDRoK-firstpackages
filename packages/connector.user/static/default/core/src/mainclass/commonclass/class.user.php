<?php

class User
{
	var $userselected=null;
	
	
	function __construct($conf,$log,$db=null)
	{
		//select moteur droit
		$moteurlowercase="";
		if(isset($conf['moteuruser']))
			$moteurlowercase=strtolower($conf['moteuruser']);
		$moteurclass=ucfirst($moteurlowercase);
		if(file_exists("core/integrate/driver/class.user.".$moteurlowercase.".php"))
		{
			include_once "core/integrate/driver/class.user.".$moteurlowercase.".php";
			eval("\$this->userselected=new User".$moteurclass."(\$conf,\$db);");
		}
		else
		{
			include_once "core/integrate/driver/class.user.nouser.php";
			$this->userselected=new UserNouser($conf,$db);
			$log->pushtolog("Echec du chargement du driver user. Verifier la configuration ou votre driver.");
		}
	}
	
}



?>