<?php

class Auth
{
	var $instanceUser;
	
	
	function __construct($instanceUser)
	{
		$this->instanceUser=$instanceUser;
		
	}
	
	function auth_connexion()
	{
		//test session ok
		if(isset($_SESSION['uid']) && $_SESSION['uid']>0)
		{
			$this->instanceUser->uid=$_SESSION['uid'];
			return $_SESSION['uid'];
		}
	
		//get post connexion user
		$login="";
		if(isset($_POST['login']) && $_POST['login']!="")
			$login=$_POST['login'];
			
		$pwd="";
		if(isset($_POST['pwd']) && $_POST['pwd']!="")
			$pwd=$_POST['pwd'];
		
		//test user ok
		$result=$this->instanceUser->checkUserLogin($login,$pwd);
		if($result && $result['pseudo']!="")
		{
			//import data du user connecté
			$_SESSION['uid']=$result['iduser'];
			$_SESSION['nom_user']=$result['pseudo'];
			$_SESSION['date_creation_user']=$result['date_creation'];
			$_SESSION['date_last_connect_user']=$result['date_last_connect'];
			$_SESSION['mail_user']=$result['login_mail'];
			$_SESSION['lang']=$result['lang'];
			
			$this->instanceUser->uid=$_SESSION['uid'];
			
			return $_SESSION['uid'];
		}
		
		$this->instanceUser->uid="none";
		
		return "none";
	}
	
	
	function auth_deconnexion()
	{
		if(isset($_POST['logoutform']) && $_POST['logoutform']!="")
		{
			session_unset();
			session_destroy();
		}
		
	}


}

?>