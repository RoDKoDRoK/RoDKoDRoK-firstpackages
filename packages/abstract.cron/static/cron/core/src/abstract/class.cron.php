<?php


class Cron extends ClassIniter
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
	
	

}



?>
