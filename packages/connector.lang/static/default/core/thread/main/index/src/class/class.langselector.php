<?php

class LangSelector
{
	
	
	function __construct()
	{
			
	}
	
	function lang_submit()
	{
		//get post lang
		$lang="";
		if(isset($_POST['lang']) && $_POST['lang']!="")
			$lang=$_POST['lang'];
			
		
		//test lang ok
		if($lang)
		{
			$_SESSION['lang']=$lang;
			
		}
		
		return $lang;
	}


}

?>