<?php

class Js extends Load
{
	var $conf;
	var $returned="";
	
	function __construct($conf,$ajax="home")
	{
		parent::__construct();
		
		$this->conf=$conf;
		$this->returned=$this->charg_js($ajax);
	}
	
	function charg_js($ajax)
	{
		$js="";
		
		//charg conf js
		$tab=$this->charg_dossier_dans_tab('core/conf');
		
		if($tab)
			foreach($tab as $fich)
			{
				if(substr($fich,-2)=="js")
					$js.="<script src=\"".$fich."\"></script>\n";
			}
		
		
		//chargement de la js globale
		$tab=$this->charg_dossier_dans_tab('core/js/corejs');
		
		if($tab)
			foreach($tab as $fich)
			{
				if(substr($fich,-2)=="js")
					$js.="<script src=\"".$fich."\"></script>\n";
			}
		
		
		//chargement de la js du packagecss
		$tab=array();
		if(isset($this->conf['packagecss']))
			$tab=$this->charg_dossier_dans_tab('core/design/packagecss/'.$this->conf['packagecss']);
		
		if($tab)
			foreach($tab as $fich)
			{
				if(substr($fich,-2)=="js")
					$js.="<script src=\"".$fich."\"></script>\n";
			}
		
		
		//chargement de la js de la page
		if(file_exists("core/js/pagejs/ajax_".$ajax.".js"))
			$js.="<script src=\"core/js/pagejs/ajax_".$ajax.".js\"></script>\n";
		
		
		return $js;
	}
	
	
}



?>