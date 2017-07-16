<?php

class YourHeader extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function headercontent_loader()
	{
		$content="";
		
		$content.="<div id='bigban'>";
		$content.="  <div id='bigimg'><img src='core/design/globalimg/bigimg.png' alt='RoDKoDRoK' /></div>";
		$content.="  <div id='bigtexte'>";
		$content.="    <div id='bigtitle'>RoDKoDRoK</div>";
		$content.="    <div id='subbigtitle'>The Content and Server Management Framework</div>";
		$content.="  </div>";
		$content.="</div>";
		
		return $content;
	}


}


?>