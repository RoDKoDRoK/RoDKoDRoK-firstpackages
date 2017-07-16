<?php


class ConnectorAuth extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance conf
		$instanceAuth=new Auth($this->user);
		$instanceAuth->auth_deconnexion(); //test si deconnexion
		
		//connexion
		$uidsession=$instanceAuth->auth_connexion();
		$this->initer['user']=$instanceAuth->instanceUser;
		
		//set instance before return
		$this->setInstance($instanceAuth);
		
		return $instanceAuth;
	}
	
	function initVar()
	{
		//charg conf
		$instanceAuth=$this->getInstance();
		//print_r($instanceAuth->returned);
		
		
		return $uidsession=$instanceAuth->instanceUser->uid;
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
