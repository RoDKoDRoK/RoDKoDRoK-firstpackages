<?php

class Showiniter extends ClassIniter
{

	var $coderesult="69";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function content_loader($elmtinitertostr,$indent,$getparams)
	{
		$content="";
		
		$initersimulation=$this->initerSimulation($getparams);
		
		$content.=$this->showIniter(false,$elmtinitertostr,$indent,$initersimulation,$getparams);
	
		return $content;
	}
	
	
	
	private function initerSimulation($getparams)
	{
		//simulation d'un initer avec les paramètres get
		$simuliniter=array();
		
		//SIMUL
		//get chain connector
		$chainconnector="none";
		if(isset($getparams['chainconnector']) && $getparams['chainconnector']!="")
			$chainconnector=$getparams['chainconnector'];

		//load chain connector
		if(file_exists("chain/connector.chain.".$chainconnector.".php"))
			include_once "chain/connector.chain.".$chainconnector.".php";
		else
		{
			include_once "chain/connector.chain.default.php";
			if(isset($firstchain) && file_exists("chain/connector.chain.".$firstchain.".php"))
			{
				include_once "chain/connector.chain.".$firstchain.".php";
				$chainconnector=$firstchain;
				//echo $firstchain;
			}
			else
				$chainconnector="default";
		}


		//charge chains dans tab
		$chemin_chain="chain";
		$loader=new Load();
		$chaintab=$loader->charg_chain_dans_tab($chemin_chain);
		//print_r($chaintab);


		//init initer
		$initer=array();
		$initer['chainconnector']=$chainconnector;
		$initer['loader']=$loader;
		$initer['chaintab']=$chaintab;


		//start connector	
		foreach($tabconnector as $connectorcour)
		{
			$connectorlowercase=strtolower($connectorcour['name']);
			$connectorclass=ucfirst($connectorlowercase);

			if(!file_exists("connector/connector.".$connectorlowercase.".php"))
				continue;
			
			include_once "connector/connector.".$connectorlowercase.".php";
			eval("\$instanceConnector=new Connector".$connectorclass."(\$initer);");
			
			eval("\$instanceConnector".$connectorclass."=\$instanceConnector;");
			eval("\$instance".$connectorclass."=\$instanceConnector->initInstance();");
			${$connectorlowercase}=$instanceConnector->initVar();
			
			//get modif du initer
			$initer=$instanceConnector->initer;
			
			//cas passage de class dans initer
			if(isset($connectorcour['classtoiniter']) && $connectorcour['classtoiniter'])
				eval("\$initer['instance".$connectorclass."']=\$instance".$connectorclass.";");
			
			//cas passage de var dans initer
			if(isset($connectorcour['vartoiniter']) && $connectorcour['vartoiniter'])
				eval("\$initer['".$connectorlowercase."']=\$".$connectorlowercase.";");
			
			
			//cas set variable ou classe spéciale (conf, db, tpl, ...)
			if(isset($connectorcour['aliasiniter']) && $connectorcour['aliasiniter']!="none")
			{
				//class spéciale
				if(isset($connectorcour['classtoiniter']) && $connectorcour['classtoiniter'] && (!isset($connectorcour['vartoiniter']) || !$connectorcour['vartoiniter']))
				{
					eval("\$".$connectorcour['aliasiniter']."=\$instance".$connectorclass.";");
					eval("\$initer['".$connectorcour['aliasiniter']."']=\$instance".$connectorclass.";");
				}
				//variable spéciale (prioritaire pour variable, écrase la classe si var et class sont utilisés)
				if(isset($connectorcour['vartoiniter']) && $connectorcour['vartoiniter'])
				{
					eval("\$".$connectorcour['aliasiniter']."=\$".$connectorlowercase.";");
					eval("\$initer['".$connectorcour['aliasiniter']."']=\$".$connectorlowercase.";");
				}
			}
			//echo "</pre>";print_r($initer['instanceDroit']);echo "</pre>";
			
			//pre exec
			$instanceConnector->reloadIniter($initer);
			$instanceConnector->preexec();
			$initer=$instanceConnector->initer;
		}


		//post exec connector	
		foreach($tabconnector as $connectorcour)
		{
			$connectorlowercase=strtolower($connectorcour['name']);
			$connectorclass=ucfirst($connectorlowercase);
			
			if(!file_exists("connector/connector.".$connectorlowercase.".php"))
				continue;
			
			eval("\$instanceConnector=\$instanceConnector".$connectorclass.";");
			//$instanceConnector->initer=$initer;
			$instanceConnector->reloadIniter($initer);
			$instanceConnector->postexec();
			$initer=$instanceConnector->initer;
			
		}
		//...SIMUL
		
		$simuliniter=$initer;
		
		return $simuliniter;
	}

}


?>