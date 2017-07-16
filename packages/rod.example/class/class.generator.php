<?php

class RodExampleGenerator extends PackageGenerator
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		
	}
	
	
	
	
	
	function prepareDataForTpl($instance="")
	{
		$data=array();
		
		$data=parent::prepareDataForTpl($instance);
		
		//add data specific
		
		
		return $data;
	}
	
	

}

?>
