<?php

class EventIntegratorOnchainload extends EventIntegrator
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
		//get pagecour
		//$pagecour=$this->instanceVar->varget("page");
		$pagecour="";
		if(isset($this->page))
			$pagecour=$this->page;
		
		//cas execution limitée à une page particulière
		if(isset($params['pagetoexecevent']) && $params['pagetoexecevent']!="")
		{
			if(is_array($params['pagetoexecevent']) && array_search($pagecour,$params['pagetoexecevent'])!==false)
				return true;
			else if($params['pagetoexecevent']==$pagecour)
				return true;
			
			return false;
		}
		
		return true;
	}
	
	
}



?>