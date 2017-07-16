<?php

class Syncsharedpackage extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
	{
		return $this->sync_sharedpackage();
	
	}


	function sync_sharedpackage()
	{
		//shareer init
		$shareer=null;
		if($this->includer->include_pratikclass("Shareer"))
			$shareer=new PratikShareer($this->initer);
		
		
		//vérifie si de nouveaux packages sont disponibles dans le dossier package et les ajoute à la bd
		
		
		$tabpackagefromdb=array();
		$tabdatapackagefromdb=null;
		if(isset($this->includer) && $this->includer->include_otherclass("index","listsharedpackage"))
		{
			$instanceOther=new Sharedpackage($this->initer);
			$tabdatapackagefromdb=$instanceOther->data_loader(); //$tabdatapackagefromdb=$instanceOther->data_loader(true,true);
		}
		
		//prepare tab from db et test db result has a folder
		if($tabdatapackagefromdb)
			foreach($tabdatapackagefromdb as $datapackagefromdb)
			{
				$packagecour=$tabpackagefromdb[]=$datapackagefromdb['nomcodesharedpackage'];
				
				
				//test db result has folder
				if($shareer->getFileLink($packagecour.$this->instanceConf->get("extpackage"),substr($this->arkitect->get("ext.mirror.packages"),1))=="")
				{
					//suppr de la db
					$this->db->query("delete from `sharedpackage` where nomcodesharedpackage='".$packagecour."'");
				}
			}
		
		
		
		
		$tabpackagefromsrclinks=array();
		$tabcheminpackagefromsrclinks=array();
		for($cptsrclink=0;$cptsrclink<count($shareer->getTabSrcLink());$cptsrclink++)
		{
			$tabtmp=$this->loader->charg_url_unique_dans_tab($shareer->getSrcLink($cptsrclink).$this->arkitect->get("ext.mirror.packages")."/");
			$tabcheminpackagefromsrclinks=array_merge($tabcheminpackagefromsrclinks,$tabtmp);
		}
		//print_r($tabcheminpackagefromsrclinks);
		
		//prepare tab from srclinks
		if($tabcheminpackagefromsrclinks)
			foreach($tabcheminpackagefromsrclinks as $packagecour)
			{
				//$packagecour=substr($packagecour,(strrpos($packagecour,"/")));
				$packagecour=str_replace($this->instanceConf->get("extpackage"),"",$packagecour);
				
				$tabpackagefromsrclinks[]=$packagecour;
			}
		
		//test folder is in db
		foreach($tabpackagefromsrclinks as $packagecour)
		{
			//test folder is in db
			if(array_search($packagecour,$tabpackagefromdb)===false)
			{
				//ajout dans la db
				$this->db->query("insert into `sharedpackage` (`idsharedpackage`, `nomcodesharedpackage`, `nomsharedpackage`) values (NULL,'".$packagecour."','".$packagecour."')");
				
			}
			
		}
		
		return true;
	}
	
	
	function checkCronIsExecutable($params=array())
	{
		//shareer init
		$shareer=null;
		if($this->includer->include_pratikclass("Shareer"))
			$shareer=new PratikShareer($this->initer);
		
		//check nb files sharedpackage != nb entries in db table sharedpackage
		
		//count nbchain db
		$nbsharedpackagedb=0;
		$reqcheck=$this->db->query("select count(idsharedpackage) as nbsharedpackage FROM `sharedpackage`");
		if($rescheck=$this->db->fetch_array($reqcheck))
		{
			$nbsharedpackagedb=$rescheck['nbsharedpackage'];
		}
		
		//count nb chain files
		$tabsharedpackagepath=$shareer->getTabSrcLink();
		$nbsharedpackagefiles=0;
		if(is_array($tabsharedpackagepath))
			foreach($tabsharedpackagepath as $sharedpackagepathcour)
			{
				$tabsharedpackage=$this->loader->charg_url_unique_dans_tab($sharedpackagepathcour.$this->arkitect->get("ext.mirror.packages")."/");
				$nbsharedpackagefiles+=count($tabsharedpackage);
			}
		
		if($nbsharedpackagefiles!=$nbsharedpackagedb)
		{
			return true;
		}
		
		return false;
	}
	
	

}

?>