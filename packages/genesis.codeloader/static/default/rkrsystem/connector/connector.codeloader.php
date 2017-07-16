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
		if(isset($this->initer['transversedata']['connector.codeloader']['cptconnectorcall']))
			$this->initer['transversedata']['connector.codeloader']['cptconnectorcall']++;
		else
			$this->initer['transversedata']['connector.codeloader']['cptconnectorcall']="1";
			
		//echo "transversedata=".$this->initer['transversedata']['connector.codeloader']['cptconnectorcall'];
		//echo $this->showIniter(true);
		
		
		$codeloaded="";
		
		if($instanceCodeLoader==null)
			return $codeloaded;
		
		//load and return code
		$tabcode=array();
		//default tabcode
		//$tabcode=$this->arkitect->get("initialconf","initialcodeloader"); //OLD TO KILL
		$tabtmp=$this->genesisdbfromfile->join("inner", "", "chainloadcodesrc", "codesrc", array("idcodesrc"=>"idcodesrc"));
		$tabtmp=$this->genesisdbfromfile->join("inner", "", $tabtmp, "chain", array("idchain"=>"idchain"));
		$tabtmp=$this->genesisdbfromfile->where("", "nomcodechain", $this->chainconnector, $tabtmp);
		$tabtmp=$this->genesisdbfromfile->where("", "actif", "1", $tabtmp);
		$tabtmp=$this->genesisdbfromfile->where("", "cptconnectorcall", $this->initer['transversedata']['connector.codeloader']['cptconnectorcall'], $tabtmp);
		$tabtmp=$this->genesisdbfromfile->orderby("ordre", $tabtmp);
		$tabcode=$tabtmp;
		
		//select code to load from db
		if(isset($this->db) && $this->db!=null)
		{
			$tabcodetmp=array();
			$req=$this->db->query("select * from `codesrc`,`chainloadcodesrc`,`chain` 
									where 
										`codesrc`.idcodesrc=`chainloadcodesrc`.idcodesrc and 
										`chain`.idchain=`chainloadcodesrc`.idchain and 
										nomcodechain='".$this->chainconnector."' and 
										actif='1' and 
										cptconnectorcall='".$this->initer['transversedata']['connector.codeloader']['cptconnectorcall']."' 
									order by ordre");
			while($res=$this->db->fetch_array($req))
				$tabcodetmp[]=$res;
			if(count($tabcodetmp)>0)
				$tabcode=$tabcodetmp;
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
