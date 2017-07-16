<?php


class ConnectorMessage extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//récupération des messages d'alerte
		$instanceMessage=new Message();
		
		
		//set instance before return
		$this->setInstance($instanceMessage);
		
		return $instanceMessage;
	}
	
	function initVar()
	{
		//charg conf
		$instanceMessage=$this->getInstance();
		//print_r($instanceMessage->returned);

		return $message=$instanceMessage->get_message();
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
