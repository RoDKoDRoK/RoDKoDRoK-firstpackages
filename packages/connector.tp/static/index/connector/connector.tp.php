<?php


class ConnectorTp extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//import template
		$instanceTpl=new Tp($this->initer['conf'],$this->initer['log']);
		
		
		//set instance before return
		$this->setInstance($instanceTpl);
		
		return $instanceTpl;
	}
	
	function initVar()
	{
		//charg conf
		$instanceTpl=$this->getInstance();
		//print_r($instanceTpl->tpselected);

		return $tpl=$instanceTpl->tpselected;
	}

	function preexec()
	{
		
		return null;
	}

	function postexec()
	{
		return null;
	}

	function end()
	{	
		//remplir tpl pour les noms de variable directement
		if(isset($this->initer['toprint']['self']))
			foreach($this->initer['toprint']['self'] as $idtoprint=>$valuetoprint)
				$this->initer['tpl']->remplir_template($idtoprint,$valuetoprint);
		if(isset($this->initer['toprint']['other']))
			foreach($this->initer['toprint']['other'] as $idtoprint=>$valuetoprint)
				$this->initer['tpl']->remplir_template($idtoprint,$valuetoprint);
		
		//remplir avec le tableau toprint
		$this->initer['tpl']->remplir_template("toprint",$this->initer['toprint']);
		
		
		//charg contenu page
		$tpltouse="core/tpl/".$this->initer['maintemplate'];
		if(!file_exists($tpltouse))
		{
			$tpltouse="core/tpl/".$this->chainconnector.".tpl";
		}
		
		if(!file_exists($tpltouse))
		{
			$this->log->pushtolog("Error template - check your configuration file (core/conf/conf/conf.tp.php)");
			echo "Error template - check your configuration file (core/conf/conf/conf.tp.php)";
			exit;
		}
		else
			$this->initer['tpl']->affich_template($tpltouse);
		
		return null;
	}



}



?>
