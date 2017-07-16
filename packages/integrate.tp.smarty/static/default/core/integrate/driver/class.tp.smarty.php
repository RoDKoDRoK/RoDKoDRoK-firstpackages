<?php

class TemplateSmarty
{
	var $oSmarty=null;
	
	var $dirtmptpl='core/files/tmp/templates_c';
	
	function __construct()
	{
		//parent::__construct();
		$this->preparer_template();
	}
	
	function preparer_template()
	{
		//include lib smarty
		//include "lib/Smarty-3.1.21/libs/Smarty.class.php";

		// Instancier notre objet smarty
		$this->oSmarty = new Smarty();

		// Fixer les chemins de template (optionnel)
		//$this->oSmarty->template_dir = '../templates';	
		$this->oSmarty->compile_dir = $this->dirtmptpl;

	}
	
	function remplir_template($destination,$contenu)
	{
		// 2. Recensement dans smarty
		$this->oSmarty->assign($destination, $contenu);

	}
	
	function affich_template($tpl="index.tpl")
	{
		// 3. Affichage du template après passage de l'objet
		$this->oSmarty->display($tpl);
	}
	
	function get_template($tpl="index.tpl")
	{
		return $this->oSmarty->fetch($tpl);
	}
	
	function clear_cache_template($tpl="all",$method="moteur")
	{
		if($tpl=="all")
		{
			if($method=="manual")
			{
				$this->rrmdir($this->dirtmptpl);
				return true;
			}
			else
			{
				$this->oSmarty->clearAllCache();
				return true;
			}
		}
		
		$this->oSmarty->clear_cache($tpl);
		return true;
	}
	
	
	
	private function rrmdir($dir) {
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir"){
				$this->rrmdir($dir."/".$object);
			 }else{ 
				unlink($dir."/".$object);
			 }
		   }
		 }
		 reset($objects);
		 
		 //force close dir before remove (php7)
		 $closer=opendir($dir);
		 closedir($closer);
		 
		 rmdir($dir);
	  }
	}
	
}



?>