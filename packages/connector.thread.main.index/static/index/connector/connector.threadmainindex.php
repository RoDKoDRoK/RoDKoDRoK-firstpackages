<?php


class ConnectorThreadmainindex extends Connector
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
		if(file_exists($this->arkitect->get("thread.index").$this->arkitect->get("ext.firstclass")."/class.".$this->initer['page'].".php"))
			include_once $this->arkitect->get("thread.index").$this->arkitect->get("ext.firstclass")."/class.".$this->initer['page'].".php";
		if(file_exists($this->arkitect->get("thread.index").$this->arkitect->get("ext.secundaryclass")."/".$this->initer['page']))
		{
			$tab_secundary_class=$loader->charg_dossier_dans_tab($this->arkitect->get("thread.index").$this->arkitect->get("ext.secundaryclass")."/".$this->initer['page']);
			foreach($tab_secundary_class as $class_to_load)
				include_once $class_to_load;
		}
		include_once $this->arkitect->get("thread.index").$this->arkitect->get("ext.control")."/".$this->initer['page'].".php";
			
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
