<?php

class Synclibintegrator extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
	{
		return $this->sync_libintegrator();
	
	}


	function sync_libintegrator()
	{
		//scan des libintegrator et ajout des new lib dans la db
		$libintegratorfolder="core/integrate/libintegrator";
		$tablibintegrator=$this->loader->charg_dossier_unique_dans_tab($libintegratorfolder);
		
		foreach($tablibintegrator as $libintegratorcour)
		{
			//get nomcodelib and nomcodelibtype
			$tmpnomcode=substr($libintegratorcour,strlen($libintegratorfolder."/libintegrator."),(-(strlen(".php"))));
			$tabtmpnomcode=explode(".",$tmpnomcode);
			$nomcodelibtype=$tabtmpnomcode[0];
			$nomcodelib=$tabtmpnomcode[1];
			$nomcodeclass=ucfirst($nomcodelib);
			for($i=2;$i<count($tabtmpnomcode);$i++)
			{
				$nomcodelib.="_".$tabtmpnomcode[$i];
				$nomcodeclass.=ucfirst($nomcodelib);
			}
			
			//addtodb
			include_once $libintegratorcour;
			eval("\$instanceLibIntegrator=new LibIntegrator".$nomcodeclass."(\$this->initer);");
			$instanceLibIntegrator->setNomcodelib($nomcodelib);
			$instanceLibIntegrator->setNomcodelibtype($nomcodelibtype);
			$instanceLibIntegrator->addtodb();
		}
		
		return true;
	}
	
	
	
	function checkCronIsExecutable($params=array())
	{
		//check nb files libintegrator != nb entries in db table lib
		
		//count nblib db
		$nblibdb=0;
		$reqcheck=$this->db->query("select count(idlib) as nblib FROM `lib`");
		if($rescheck=$this->db->fetch_array($reqcheck))
		{
			$nblibdb=$rescheck['nblib'];
		}
		
		//count nb libintegrator files
		$tablibintegrator=$this->loader->charg_dossier_unique_dans_tab("core/integrate/libintegrator");
		$nblibfiles=count($tablibintegrator);
		
		if($nblibfiles!=$nblibdb)
		{
			return true;
		}
		
		return false;
	}
	
	

}

?>