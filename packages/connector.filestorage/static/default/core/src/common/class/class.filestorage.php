<?php

class Filestorage extends Load
{
	var $filestorage=array();
	
	var $conf;
	
	
	function __construct($conf,$log,$includer=null)
	{
		$this->conf=$conf;
		
		//chargement des formaters
		$tab_chemins_driver=$this->charg_dossier_dans_tab("integrate/driver");
		
		if($tab_chemins_driver)
			foreach($tab_chemins_driver as $chemin_driver_to_load)
			{
				if($drivername=strstr($chemin_driver_to_load,"class.filestorage."))
				{
					$drivername=substr($drivername,strrpos($drivername,"class.filestorage.")+strlen("class.filestorage."),-4);
					$drivername=strtolower($drivername);
					$driverclass=ucfirst($drivername);
					
					include $chemin_driver_to_load;
					eval("\$instanceDriver=new Filestorage".$driverclass."(\$conf,\$log,\$includer);");
					$this->filestorage[$drivername]=$instanceDriver;
					
				}
			}
	}
	
	
	
	function getDefaultFileStorage()
	{
		if(isset($this->conf['defaultfilestorage']))
			return $this->conf['defaultfilestorage'];
		
		return "nofile";
	}
}



?>