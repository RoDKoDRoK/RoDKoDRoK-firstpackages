<?php


class ConnectorMultisite extends Connector
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
	}


	function initInstance()
	{
		//instance multisite
		$instanceMultisite=new Multisite($this->initer);
		
		
		$newurl=$instanceMultisite->reconstructUrl();
		if($newurl)
		{
			$redirect="";
			$redirect.="<form id='tmpform' action='".$newurl."'>";
			foreach($_POST as $namepost=>$valuepost)
			{
				$redirect.="<input type='hidden' name='".$namepost."' value='".$valuepost."' />";	
			}
			$redirect.="</form>";
			$redirect.="<script>document.getElementById('".$tmpform."').submit();</script>";
			
			echo $redirect;
			exit;	
		}
		
		//set instance before return
		$this->setInstance($instanceMultisite);
		
		return $instanceMultisite;
	}
	
	function initVar()
	{
		return null;
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
