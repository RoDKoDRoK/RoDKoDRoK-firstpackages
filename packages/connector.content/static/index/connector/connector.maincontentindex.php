<?php


class ConnectorMaincontentindex extends Connector
{
	var $chemintpl="core/dev/template/";
	
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
		if(file_exists("core/dev/class/pageclass/class.".$this->initer['page'].".php"))
			include_once "core/dev/class/pageclass/class.".$this->initer['page'].".php";
		if(file_exists("core/dev/class/secundaryclass/".$this->initer['page']))
		{
			$tab_secundary_class=$loader->charg_dossier_dans_tab("core/dev/class/secundaryclass/".$this->initer['page']);
			foreach($tab_secundary_class as $class_to_load)
				include_once $class_to_load;
		}
		include_once "core/dev/page/".$this->initer['page'].".php";
			
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
