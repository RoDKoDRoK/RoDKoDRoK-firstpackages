<?php

class Conf extends Load
{
	//conf des fichiers
	var $conf=array();
	
	
	function __construct()
	{
		parent::__construct();
		$this->charg_conf();
		
	}
	
	
	
	function charg_conf()
	{	
		$conf=array();
		
		//conf globale
		$tab_chemins_conf=$this->charg_dossier_dans_tab("core/conf");
		
		if(isset($tab_chemins_conf) && $tab_chemins_conf)
			foreach($tab_chemins_conf as $chemin_conf_to_load)
			{
				if(strstr($chemin_conf_to_load,".htaccess")=="" && substr($chemin_conf_to_load,-4)==".php")
					include $chemin_conf_to_load;
			}
		
		$this->conf=array_merge($this->conf,$conf);

	}
	
	
	function get($idconf="",$idconf2="",$idconf3="",$idconf4="",$idconf5="")
	{
		$value="";
		
		if($idconf!="" && isset($this->conf[$idconf]))
		{
			$value=$this->conf[$idconf];
			if($idconf2!="" && isset($this->conf[$idconf][$idconf2]))
			{
				$value=$this->conf[$idconf][$idconf2];
				if($idconf3!="" && isset($this->conf[$idconf][$idconf2][$idconf3]))
				{
					$value=$this->conf[$idconf][$idconf2][$idconf3];
					if($idconf4!="" && isset($this->conf[$idconf][$idconf2][$idconf3][$idconf4]))
					{
						$value=$this->conf[$idconf][$idconf2][$idconf3][$idconf4];
						if($idconf5!="" && isset($this->conf[$idconf][$idconf2][$idconf3][$idconf4][$idconf5]))
						{
							$value=$this->conf[$idconf][$idconf2][$idconf3][$idconf4][$idconf5];
						}
					}
				}
			}
		}
		
		return $value;
	}
	
	
}



?>