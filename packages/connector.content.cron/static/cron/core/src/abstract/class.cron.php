<?php


class Cron extends Task
{
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	function launchcron()
	{
		return true;
	}
	

}



?>
