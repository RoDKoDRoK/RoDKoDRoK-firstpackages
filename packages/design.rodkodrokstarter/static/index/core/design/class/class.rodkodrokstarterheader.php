<?php

class RodkodrokHeader extends ClassIniter
{
	
	function __construct($initer=array())
	{
		parent::__construct($initer);
	
	}
	

	function headercontent_loader()
	{
		$content="";
		
		$content.="<div id='bigban'>";
		$content.="  <div id='bigimg'><img width='400px' src='core/design/globalimg/rodkodrok_logo.png' alt='RoDKoDRoK' /></div>";
		$content.="  <div id='bigtexte'>";
		$content.="    <div id='bigtitle'>".$this->maintitle."</div>";
		$content.="    <div id='subbigtitle'>".$this->mainsubtitle."</div>";
		$content.="  </div>";
		$content.="</div>";
		
		return $content;
	}


}


?>