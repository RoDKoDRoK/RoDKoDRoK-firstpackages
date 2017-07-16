<?php


class ConnectorAuthtoken extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceAuth=new AuthToken($instanceDroit);
		
		//set instance before return
		$this->setInstance($instanceAuth);
		
		return $instanceAuth;
	}
	
	function initVar()
	{
		//charg conf
		$instanceAuth=$this->getInstance();
		//print_r($instanceAuth->returned);
		
		if(isset($this->argv))
			$instanceAuth->argv=$this->argv;
		$userloaded=$instanceAuth->authtoken_connexion($this->chainconnector);
		
		//prepare uidsession (for cache)
		$this->initer['uidsession']=0;
		if($userloaded && isset($userloaded['uid']))
			$this->initer['uidsession']=$userloaded['uid'];
		
		return $userloaded;
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
		return null;
	}



}



?>
