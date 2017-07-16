<?php


class ConnectorCodeloader extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//include_once "core/src/ark/class.codeloader.php";
		$instanceCodeLoader=null;
		if(class_exists("CodeLoader"))
			$instanceCodeLoader=new CodeLoader($this->initer);
		
		$this->setInstance($instanceCodeLoader);
		
		return $instanceCodeLoader;
	}
	
	function initVar()
	{
		$instanceCodeLoader=$this->getInstance();
		
		
		//cpt nb call of connector.codeloader
		if(isset($this->db) && $this->db!=null && isset($this->initer['transversedata']['connector.codeloader']['cptconnectorcall']))
			$this->initer['transversedata']['connector.codeloader']['cptconnectorcall']++;
		else
			$this->initer['transversedata']['connector.codeloader']['cptconnectorcall']="0";
		
		//echo $this->showIniter(true);
		
		
		$codeloaded="";
		
		if($instanceCodeLoader==null)
			return $codeloaded;
		
		//load and return code
		$tabcode=array();
		//default tabcode
		$tabcode=$this->arkitect->get("initialconf","initialcodeloader");
		
		//select code to load from db
		if(isset($this->db) && $this->db!=null)
		{
			$tabcode=array();
			$req=$this->db->query("select * from `codesrc`,`chainloadcodesrc`,`chain` 
									where 
										`codesrc`.idcodesrc=`chainloadcodesrc`.idcodesrc and 
										`chain`.idchain=`chainloadcodesrc`.idchain and 
										nomcodechain='".$this->chainconnector."' and 
										actif='1' and 
										cptconnectorcall='".$this->initer['transversedata']['connector.codeloader']['cptconnectorcall']."' 
									order by ordre");
			while($res=$this->db->fetch_array($req))
				$tabcode[]=$res;
		}
		
		//loading
		foreach($tabcode as $codetoload)
			$codeloaded.=$instanceCodeLoader->load_code($codetoload['nomcodecodesrc'],$codetoload['typecodesrc']);
		
		
		return $codeloaded;
	}

	function preexec()
	{	
		return null;
	}

	function postexec()
	{
		return null;
	}

	function end()
	{
		return null;
	}



}



?>
