<?php


class ConnectorMaincontentajax extends Connector
{
	var $chemintpl="core/dev/js/ajax/template/";

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		return null;
	}
	
	function initVar()
	{
		return null;
	}

	function preexec()
	{
		//include main content
		if(file_exists("core/dev/js/ajax/class/fluxajaxclass/class.".$this->page.".php"))
			include_once "core/dev/js/ajax/class/fluxajaxclass/class.".$this->page.".php";
		if(file_exists("core/dev/js/ajax/class/secundaryclass/".$this->page))
		{
			$tab_secundary_class=$loader->charg_dossier_dans_tab("core/dev/js/ajax/class/secundaryclass/".$this->page);
			foreach($tab_secundary_class as $class_to_load)
				include_once $class_to_load;
		}
		include_once "core/dev/js/ajax/flux/".$this->page.".php";
				
		return null;
	}

	function postexec()
	{
		return null;
	}

	function end()
	{
		return null;
	}



}



?>
