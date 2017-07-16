<?php


class ConnectorCache extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance cache
		$instanceCache=new Cache($this->initer);
		
		$this->initer['cacheisallowed']=$instanceCache->checkcacheisallowed();
		
		
		//set instance before return
		$this->setInstance($instanceCache);
		
		return $cache=$instanceCache->cacheselected;
	}
	
	function initVar()
	{
		//charg cache
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
			$cache->writecache($this->initer['tpl']->get_template($this->arkitect->get("tpl")."/".$this->initer['maintemplate']));
		
		return null;
	}



}



?>
