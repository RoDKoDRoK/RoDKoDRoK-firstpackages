<?php

class Cache
{
	var $cacheselected=null;
	
	
	function __construct($db,$log)
	{
		$conf=$db->conf;
		//select moteur cache
		$moteurlowercase="";
		if(isset($conf['moteurcache']))
			$moteurlowercase=strtolower($conf['moteurcache']);
		$moteurclass=ucfirst($moteurlowercase);
		if(file_exists("core/integrate/driver/class.cache.".$moteurlowercase.".php"))
		{
			include_once "core/integrate/driver/class.cache.".$moteurlowercase.".php";
			eval("\$this->cacheselected=new Cache".$moteurclass."(\$db,\$log);");
		}
		else
		{
			include_once "core/integrate/driver/class.cache.nocache.php";
			$this->cacheselected=new CacheNocache($db,$log);
			$log->pushtolog("Echec du chargement du driver cache. Verifier la configuration ou votre driver.");
		}
	}
	
	
	function checkcacheisallowed()
	{
		if(isset($_GET['nocache']) && $_GET['nocache']=="ok")
			return false;
			
		return true;
	}
	
}



?>