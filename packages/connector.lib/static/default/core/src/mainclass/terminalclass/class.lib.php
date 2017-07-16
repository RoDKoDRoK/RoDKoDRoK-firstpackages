<?php

class Lib extends Load
{
	
	var $db;
	var $conf;
	
	var $log;

	var $returned;
	
	function __construct($db,$log)
	{
		//parent::__construct();
		$this->db=$db;
		$this->conf=$db->conf;
		
		$this->log=$log;
		
		$this->returned=$this->charg_lib();
	}
	
	function charg_lib()
	{
		$lib="";
		
		
		
		//chargement des librairies terminal (pour le cron aussi)
		$tab_chemins_libintegrator=$this->charg_dossier_dans_tab("core/integrate/libintegrator");
		
		if($tab_chemins_libintegrator)
			foreach($tab_chemins_libintegrator as $chemin_libintegrator_to_load)
			{
				if($othername=strstr($chemin_libintegrator_to_load,".terminal."))
				{
					$othername=substr($othername,strlen(".terminal."),-4);
					$otherclass=ucfirst($othername);
					
					include_once $chemin_libintegrator_to_load;
					eval("\$instanceLibIntegrator=new LibIntegrator".$otherclass."();");
					eval("\$lib.=\$instanceLibIntegrator->charg_".$othername."();");
				}
			}
		
		
		return $lib;
	}
	
	
	
}



?>