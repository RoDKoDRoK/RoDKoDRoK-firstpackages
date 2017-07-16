<?php


class ConnectorMaincontentterminal extends Connector
{

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
		if(file_exists("core/server/terminal/class/cmdclass/class.".$this->page.".php"))
			include_once "core/server/terminal/class/cmdclass/class.".$this->page.".php";
		if(file_exists("core/server/terminal/class/secundaryclass/".$this->page))
		{
			$tab_secundary_class=$loader->charg_dossier_dans_tab("core/server/terminal/class/secundaryclass/".$this->page);
			foreach($tab_secundary_class as $class_to_load)
				include_once $class_to_load;
		}
		include_once "core/server/terminal/cmd/".$this->page.".php";
				
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
