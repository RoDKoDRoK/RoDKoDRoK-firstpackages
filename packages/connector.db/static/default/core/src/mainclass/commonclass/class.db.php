<?php

class Db
{
	var $dbselected=null;
	
	var $conf;
	
	
	
	function __construct($conf)
	{
		$this->conf=$conf;
	
		$instanceLog=new Log($conf);
		$log=$instanceLog->logselected;
		
		//select moteur db
		$moteurlowercase="";
		if(isset($conf['maindb']['moteurbd']))
			$moteurlowercase=strtolower($conf['maindb']['moteurbd']);
		$moteurclass=ucfirst($moteurlowercase);
		if(file_exists("core/integrate/driver/class.db.".$moteurlowercase.".php"))
		{
			include_once "core/integrate/driver/class.db.".$moteurlowercase.".php";
			eval("\$this->dbselected=new Db".$moteurclass."(\$conf);");
		}
		else
		{
			include_once "core/integrate/driver/class.db.nodb.php";
			$this->dbselected=new DbNodb($conf);
			$log->pushtolog("Echec du chargement du driver db. Verifier la configuration ou votre db.");
		}
			
	}
	
	
	
	
	
	function loadAnotherDb($dbname="maindb")
	{
		$instanceLog=new Log($this->conf);
		$log=$instanceLog->logselected;
		
		//select moteur db for dbname
		$moteurlowercase="";
		$moteurclass="";
		if(isset($this->conf[$dbname]['moteurbd']))
		{
			$moteurlowercase=strtolower($this->conf[$dbname]['moteurbd']);
			$moteurclass=ucfirst($moteurlowercase);
		}
		if(file_exists("core/integrate/driver/class.db.".$moteurlowercase.".php"))
		{
			include_once "core/integrate/driver/class.db.".$moteurlowercase.".php";
			eval("return (new Db".$moteurclass."(\$this->conf,\$dbname));");
		}
		else
		{
			$log->pushtolog("Echec du chargement du driver db pour la base ".$dbname.". Verifier la configuration ou votre db.");
			
			$moteurlowercase=strtolower($this->conf['maindb']['moteurbd']);
			$moteurclass=ucfirst($moteurlowercase);
			if(file_exists("core/integrate/driver/class.db.".$moteurlowercase.".php"))
			{
				include_once "core/integrate/driver/class.db.".$moteurlowercase.".php";
				eval("return (new Db".$moteurclass."(\$this->conf));");
			}
			else
			{
				include_once "core/integrate/driver/class.db.nodb.php";
				return (new DbNodb($this->conf,$dbname));
			}
		}
		
	}


}

?>