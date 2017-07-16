<?php


class ConnectorCache extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceCache=new Cache($this->initer['db'],$this->initer['log']);
		
		$this->initer['cacheisallowed']=$instanceCache->checkcacheisallowed();
		
		
		//set instance before return
		$this->setInstance($instanceCache);
		
		return $cache=$instanceCache->cacheselected;
	}
	
	function initVar()
	{
		//charg conf
		$cache=$this->getInstance();
		$cache=$cache->cacheselected;
		//print_r($cache->returned);
		
		
		$cache->preparecachedest($this->chainconnector,$this->page,$this->conf['lang'],$this->droit,$this->uidsession);
		$cachedpage=$cache->readcache();
		if($cachedpage!="")
		{
			echo $cachedpage;
			exit;
		}
		
		return $cachedpage;
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
		$cache=$this->getInstance();
		$cache=$cache->cacheselected;
		
		//create cache
		if($this->initer['cachedpage']=="" && $this->initer['cacheisallowed'])
			$cache->writecache($this->initer['tpl']->get_template("core/tpl/".$this->initer['maintemplate']));
		
		return null;
	}



}



?>
