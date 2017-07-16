<?php

class SyncConnector extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron()
	{
		return $this->sync_connector();
	
	}


	function sync_connector()
	{
		//scan des connector et ajout des new connector dans la db
		$tabconnector=$this->loader->charg_connector_dans_tab();
		
		foreach($tabconnector as $connector)
		{
			//add to db
			if(isset($this->includer) && $this->includer->include_pratikclass("Connector"))
			{
				$pratikconnector=new PratikConnector($this->initer);
				$pratikconnector->addConnector($connector);
			}
		}
		
		return true;
	}


}

?>