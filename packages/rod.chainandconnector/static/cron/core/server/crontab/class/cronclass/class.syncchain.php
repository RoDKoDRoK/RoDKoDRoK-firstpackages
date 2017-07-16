<?php

class Syncchain extends Cron
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}


	function launchcron($params=array())
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
	
	
	function checkCronIsExecutable($params=array())
	{
		//check nb files chain - 1 (default chain) != nb entries in db table chain
		
		//count nbchain db
		$nbchaindb=0;
		$reqcheck=$this->db->query("select count(idchain) as nbchain FROM `chain`");
		if($rescheck=$this->db->fetch_array($reqcheck))
		{
			$nbchaindb=$rescheck['nbchain'];
		}
		
		//count nb chain files
		$tabchain=$this->loader->charg_dossier_unique_dans_tab("chain");
		$nbchainfiles=count($tabchain)-1;
		
		if($nbchainfiles!=$nbchaindb)
		{
			return true;
		}
		
		return false;
	}
	
	

}

?>