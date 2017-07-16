<?php

class PratikDump extends ClassIniter
{
	var $dumpselected=null;
	
	var $folderdestdump="rkrsystem/packagetrace/db/dump";
	
	
	function __construct($initer,$dumpname,$outputdump="")
	{
		//set output instead of conf
		if($outputdump!="")
			$initer['conf']['outputdump']=$outputdump;
		
		//construct
		parent::__construct($initer);
		
		//arkitect
		$this->folderdestdump=$this->arkitect->get("packagetrace.folderdestdump");
		
		
		
		$dumpfilename=$this->generateDumpFilename($dumpname);
	
		$instanceLog=new Log($this->conf);
		$log=$instanceLog->logselected;
		
		//select moteur db
		$moteurlowercase="";
		if(isset($this->conf['maindb']['moteurbd']))
			$moteurlowercase=strtolower($this->conf['maindb']['moteurbd']);
		$moteurclass=ucfirst($moteurlowercase);
		
		//select output dump format
		$outputdumplowercase="";
		if(isset($this->conf['outputdump']))
			$outputdumplowercase=strtolower($this->conf['outputdump']);
		$outputdumpclass=ucfirst($outputdumplowercase);
		
		if(file_exists("core/integrate/driver/class.dump.".$moteurlowercase."to".$outputdumplowercase.".php"))
		{
			include_once "core/integrate/driver/class.dump.".$moteurlowercase."to".$outputdumplowercase.".php";
			eval("\$this->dumpselected=new Dump".$moteurclass."To".$outputdumpclass."(\$this->initer,\$dumpfilename);");
		}
		else
		{
			include_once "core/integrate/driver/class.dump.nodump.php";
			$this->dumpselected=new DumpNodump($this->initer,$dumpfilename);
			$log->pushtolog("Echec du chargement du driver dump. Verifier la configuration ou votre driver dump.");
		}
			
	}
	
	
	function getDumpOutputExt()
	{
		$dumpoutput=$this->instanceConf->get('outputdump');
		
		$dumpoutputext="sql";
		switch($dumpoutput)
		{
			case "mysql":
				$dumpoutputext="sql";
				break;
			case "csv":
				$dumpoutputext="csv";
				break;
			default:
				$dumpoutputext="sql";
				break;
		}
		
		return $dumpoutputext;
	}
	
	function getLastDump($dumpname)
	{
		$dumpfilename="";
		
		if(isset($this->conf['chemindump']) && $this->conf['chemindump']!="")
			$this->folderdestdump=$this->conf['chemindump'];
		
		if(!is_dir($this->folderdestdump))
			mkdir($this->folderdestdump,0777,true);
		
		$tabdump=$this->loader->charg_dossier_unique_dans_tab($this->folderdestdump);
		rsort($tabdump);
		$extensioninput=$this->getDumpOutputExt();
		foreach($tabdump as $dumpfilenamecour)
		{
			if(substr($dumpfilenamecour,-3)==$extensioninput && strpos($dumpfilenamecour,$dumpname)!==false && strpos($dumpfilenamecour,$dumpname)==strlen($this->folderdestdump."/") && strlen(substr($dumpfilenamecour,strlen($this->folderdestdump."/".$dumpname)+1,-4))==14)
				return $dumpfilenamecour;
		}
		
		return $dumpfilename;
	}
	
	function generateDumpFilename($dumpname)
	{
		$dumpfilename="";
		
		if(isset($this->conf['chemindump']) && $this->conf['chemindump']!="")
			$this->folderdestdump=$this->conf['chemindump'];
		
		if(!is_dir($this->folderdestdump))
			mkdir($this->folderdestdump,0777,true);
		
		$dumpfilename.=$this->folderdestdump;
		$dumpfilename.="/";
		$dumpfilename.=$dumpname;
		$dumpfilename.=".";
		$dumpfilename.=date("YmdHis");
		$dumpfilename.=".";
		$dumpfilename.=$this->getDumpOutputExt();
		
		return $dumpfilename;
	}
	
}


?>