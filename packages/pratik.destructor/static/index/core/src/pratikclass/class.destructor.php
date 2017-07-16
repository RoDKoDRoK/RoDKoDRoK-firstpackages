<?php

class PratikDestructor extends ClassIniter
{

	function __construct($initer=array())
	{
		parent::__construct($initer);
		 
	}
	
	
	
	function rrmdir($dir) {
	   if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir"){
				$this->rrmdir($dir."/".$object);
			 }else{ 
				unlink($dir."/".$object);
			 }
		   }
		 }
		 reset($objects);
		 
		 //force close dir before remove (php7)
		 $closer=opendir($dir);
		 closedir($closer);
		 
		 rmdir($dir);
	  }
	}
	
	
	
}


?>