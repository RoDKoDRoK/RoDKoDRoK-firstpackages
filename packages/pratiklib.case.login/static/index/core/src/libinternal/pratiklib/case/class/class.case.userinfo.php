<?php

class CaseUserInfo extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
		
	}
	

	function userinfo_loader()
	{
		$userinfo=array();
		
		if(isset($_SESSION['uid']) && $_SESSION['uid']>0)
		{
			$userinfo['username']=$_SESSION['nom_user'];
			$userinfo['usermail']=$_SESSION['mail_user'];
			$userinfo['userdatelastconnect']=$_SESSION['date_last_connect_user'];
		}
		
		return $userinfo;
	}


}


?>