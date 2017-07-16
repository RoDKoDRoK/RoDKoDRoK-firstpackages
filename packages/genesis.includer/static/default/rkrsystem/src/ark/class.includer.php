<?php

class Includer
{
	var $loader=null;
	var $arkitect=null;
	var $genesisdbfromfile=null;
	
	function __construct()
	{
		//parent::__construct($initer);
		
		//prepare arkitect
		$this->loader=new Load();
		$this->arkitect=new Arkitect();
		$this->genesisdbfromfile=new DbFromFile();
		
	}
	
	function include_class($typeclass="pratikclass",$classname="example")
	{
		$typeclass=strtolower($typeclass);
		$classname=strtolower($classname);
		$classnamefirstlettermaj=ucfirst($classname);
		if(file_exists($this->arkitect->get("src.".$typeclass)."/class.".$classname.".php"))
		{
			include_once $this->arkitect->get("src.".$typeclass)."/class.".$classname.".php";
			return true;
		}
		return false;
	}
	
	
	function include_dbtableclass($dbtableclassname="example")
	{
		$dbtableclassname=strtolower($dbtableclassname);
		$dbtableclassnamefirstlettermaj=ucfirst($dbtableclassname);
		if(file_exists($this->arkitect->get("src.dbtableclass")."/class.".$dbtableclassname.".php"))
		{
			include_once $this->arkitect->get("src.dbtableclass")."/class.".$dbtableclassname.".php";
			return true;
		}
		return false;
	}
	
	
	function include_pratikclass($pratikclassname="example")
	{
		$pratikclassname=strtolower($pratikclassname);
		$pratikclassnamefirstlettermaj=ucfirst($pratikclassname);
		if(file_exists($this->arkitect->get("src.pratikclass")."/class.".$pratikclassname.".php"))
		{
			include_once $this->arkitect->get("src.pratikclass")."/class.".$pratikclassname.".php";
			return true;
		}
		return false;
	}
	
	
	function include_otherclass($chain,$otherclassname="example",$withsecundaryclass=true)
	{
		$otherclassname=strtolower($otherclassname);
		$otherclassnamefirstlettermaj=ucfirst($otherclassname);
		
		//$tabclasspath=$this->instanceConf->get("classpath".$chain);
		$tabclasspath=$this->genesisdbfromfile->where("", "nomcodechain", $chain, "classpath");
		if($tabclasspath)
			foreach($tabclasspath as $pathcour)
			{
				//ajout pour genesisfromdb
				$pathcour=$pathcour['classpath'];
				//...fin ajout pour genesisfromdb
				
				if(file_exists($pathcour."/class.".$otherclassname.".php"))
				{
					//check secundaryclass
					if($withsecundaryclass)
					{
						//$tabsecundaryclasspath=$this->instanceConf->get("secundaryclasspath".$chain);
						$tabsecundaryclasspath=$this->genesisdbfromfile->where("", "nomcodechain", $chain, "secundaryclasspath");
						if($tabsecundaryclasspath!="")
							foreach($tabsecundaryclasspath as $secundarypathcour)
							{
								//ajout pour genesisfromdb
								$secundarypathcour=$secundarypathcour['secundaryclasspath'];
								//...fin ajout pour genesisfromdb
								
								$tabsecundaryclass=$this->loader->charg_dossier_unique_dans_tab($secundarypathcour."/".$otherclassname);
								if(count($tabsecundaryclass)>0)
									foreach($tabsecundaryclass as $secundaryclass)
										include_once $secundaryclass;
							}
					}
					
					//include main other class
					include_once $pathcour."/class.".$otherclassname.".php";
					return true;
				}
			}
		
		return false;
	}
	
	
}



?>