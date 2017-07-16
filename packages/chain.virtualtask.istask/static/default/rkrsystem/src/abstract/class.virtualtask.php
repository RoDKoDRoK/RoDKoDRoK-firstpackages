<?php


class VirtualTask extends Task
{
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	
	
	
	function execvirtualtask($params=array())
	{
		return true;
	}
	
	
	function checkVirtualtaskIsExecutable($params=array())
	{
		return true;
	}
	
	
	
	function execTask($params=array())
	{
		return $this->execvirtualtask($params);
	}
	
	
	function checkTaskIsExecutable($params=array())
	{
		return $this->checkVirtualtaskIsExecutable($params);
	}
	
	
}



?>
