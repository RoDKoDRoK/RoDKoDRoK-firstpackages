<?php

class SyncChain extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron()
	{
		return $this->sync_chain();
	
	}


	function sync_chain()
	{
		//scan des chain et ajout des new chain dans la db
		$tabchain=$this->loader->charg_chain_dans_tab();
		
		foreach($tabchain as $chain)
		{
			//add to db
			if(isset($this->includer) && $this->includer->include_pratikclass("Chain"))
			{
				$pratikchain=new PratikChain($this->initer);
				$pratikchain->addChain($chain);
			}
		}
		
		return true;
	}


}

?>