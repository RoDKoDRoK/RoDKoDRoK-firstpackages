<?php

class Formater extends Load
{
	var $formater=array();
	
	
	function __construct($conf,$log)
	{
		//chargement des formaters
		$tab_chemins_formater=$this->charg_dossier_dans_tab("integrate/formater");
		
		if($tab_chemins_formater)
			foreach($tab_chemins_formater as $chemin_formater_to_load)
			{
				if($formatername=strstr($chemin_formater_to_load,".formater."))
				{
					$tabformatername=substr($formatername,strlen(".formater."),-4);
					$tabformatername=strtolower($tabformatername);
					$tabformatername=explode(".",$tabformatername);
					
					$cpt=0;
					foreach($tabformatername as $formatnamecour)
						$tabformaterclass[$cpt++]=ucfirst($formatnamecour);
					
					//check conf formater
					if(!isset($conf['formater'.$tabformatername[0]]) || (isset($conf['formater'.$tabformatername[0]]) && $conf['formater'.$tabformatername[0]]==""))
						$conf['formater'.$tabformatername[0]]="origin";
					
					if($conf['formater'.$tabformatername[0]]==$tabformatername[1])
					{
						include $chemin_formater_to_load;
						eval("\$instanceFormater=new Formater".$tabformaterclass[0].$tabformaterclass[1]."();");
						$this->formater[$tabformatername[0]]=$instanceFormater;
					}
				}
			}
	}
	
}



?>