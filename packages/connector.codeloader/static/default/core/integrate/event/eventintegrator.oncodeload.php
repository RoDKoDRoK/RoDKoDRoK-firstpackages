<?php

class EventIntegratorOncodeload extends EventIntegrator
{

	
	function __construct($initer=array())
	{
		parent::__construct($initer);

	}
	
	
	function execEvent($params=array())
	{
		return parent::execEvent($params);
	}
	
	
	
	function checkEventCanExecuteTask($params=array())
	{
		return true;
	}
	
	
}



?>