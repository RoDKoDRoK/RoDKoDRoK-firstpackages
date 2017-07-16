<?php

class Message
{

	function __construct()
	{

	}
	
	
	
	function get_message()
	{
		$message="";
		if(isset($_SESSION['message'][0]) && $_SESSION['message'][0]!="")
		{
			$cpt=0;
			foreach($_SESSION['message'] as $messagecour)
			{
				$message.="<div class='message indent ".$_SESSION['typemessage'][$cpt]."'>";
				$message.=$messagecour;
				$message.="</div>";
			}
		}
		
		$_SESSION['message']=array();
		$_SESSION['typemessage']=array();
		
		return $message;
	}
	
	
	function set_message($message="",$typemessage="alert")
	{
		$_SESSION['message'][]=$message;
		$_SESSION['typemessage'][]=$typemessage;
	}


	
	
	
}



?>