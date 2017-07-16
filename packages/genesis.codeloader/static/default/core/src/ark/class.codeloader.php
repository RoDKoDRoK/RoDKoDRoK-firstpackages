<?php

class CodeLoader extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	}
	
	
	
	function load_code($code="class",$typecode="",$codefile="")
	{
		$codeloaded="";
		
		//check typecode ok
		if($typecode=="")
		{
			$tabtmp=$this->genesisdbfromfile->where("","nomcodecodesrc",$code,"codesrc");
			$typecode=$tabtmp['typecodesrc'];
			
			if(isset($this->db) && $this->db!=null && method_exists($this->requestor,"checkTableExists") && $this->requestor->checkTableExists("codesrc"))
			{
				$req=$this->db->query("select * from `codesrc` where nomcodecodesrc='".$code."'");
				if($res=$this->db->fetch_array($req))
					$typecode=$res['typecodesrc'];
			}
		}
		
		//prepare data
		$code=strtolower($code);
		$typecode=strtolower($typecode);
		$typecodeclass=ucfirst($typecode);
		
		//select codeloader from integrate with $typecode
		if(file_exists($this->arkitect->get("integrate.codeloader")."/class.typecodeloader.".$typecode.".php"))
		{
			include_once $this->arkitect->get("integrate.codeloader")."/class.typecodeloader.".$typecode.".php";
			eval("\$typeCodeloader=new TypeCodeLoader".$typecodeclass."(\$this->initer);");
		}
		else
		{
			//pushtolog...
			return $codeloaded;
		}
		
		//cas codefile unique à charger
		if($codefile!="" && file_exists($codefile))
		{
			$codeloaded.=$typeCodeloader->load_code_from_file($this->arkitect->get("src.ponctual")."/".$code."/".$codefile);
			return $codeloaded;
		}
		
		//cas codeloader for every file in $code
		//common load in tab
		$chemincommontoload=$this->arkitect->get("src.common")."/".$code;
		$tabcodefilecommon=array();
		if(is_dir($chemincommontoload))
			$tabcodefilecommon=$this->loader->charg_dossier_dans_tab($chemincommontoload);
		
		
		//chargement event oncodeload
		if(isset($this->includer) && $this->includer->include_pratikclass("Event"))
		{
			//params in code
			$params=array();
			$params['code']=$code;
			//...todo in params : typecodesrc, etc...
			
			//exec event
			$pratikevent=$this->instanciator->newInstance("PratikEvent",$this->initer);
			if($pratikevent)
				$tabreturnedfromevent=$pratikevent->execEvent("oncodeload",$params);
		}
		
		//merge returned
		$tabcodefile=$tabcodefilecommon;
		if(isset($tabreturnedfromevent) && is_array($tabreturnedfromevent))
			foreach($tabreturnedfromevent as $returnedfromevent)
				$tabcodefile=array_merge($tabcodefile,$returnedfromevent);
		
		//loading final tab
		foreach($tabcodefile as $codefile)
			$codeloaded.=$typeCodeloader->load_code_from_file($codefile);
		
		return $codeloaded;
	}
	
	
}



?>