<?php


class Cron extends Task
{
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function launchcron($params=array())
	{
		return true;
	}
	
	
	function checkCronIsExecutable($params=array())
	{
		return true;
	}
	
	
	
	function execTask($params=array())
	{
		return $this->launchcron($params);
	}
	
	
	function checkTaskIsExecutable($params=array())
	{
		return $this->checkCronIsExecutable($params);
	}
	
	
}



?>
