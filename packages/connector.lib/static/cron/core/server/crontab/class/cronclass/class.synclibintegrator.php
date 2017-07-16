<?php

class SyncLibIntegrator extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron()
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


}

?>