<?php

class Css extends Load
{
	var $conf;
	var $returned="";
	
	function __construct($conf,$page="home")
	{
		parent::__construct();
		
		$this->conf=$conf;
		
		if($page=="mail")
		{
			$this->returned=$this->charg_mail_css();
		}
		else
		{
			$this->returned=$this->charg_css($page);
			$this->returned.=$this->charg_favicon();
		}
	}
	
	function charg_css($page)
	{
		$css="";
		
		//chargement de la css
		$tab=$this->charg_dossier_dans_tab('core/dev/css/corecss');
		
		if(isset($tab))
			foreach($tab as $fich)
			{
				if(substr($fich,-3)=="css")
					$css.="<link rel=\"stylesheet\" href=\"".$fich."\" type=\"text/css\" />\n";
			}
		
		
		//chargement de la css du packagecss
		$tab=array();
		if(isset($this->conf['packagecss']))
			$tab=$this->charg_dossier_dans_tab('core/design/packagecss/'.$this->conf['packagecss']);
		
		if(isset($tab))
			foreach($tab as $fich)
			{
				if(substr($fich,-3)=="css")
					$css.="<link rel=\"stylesheet\" href=\"".$fich."\" type=\"text/css\" />\n";
			}
		
		
		//chargement de la css de la page
		if(file_exists("core/dev/css/pagecss/".$page.".css"))
			$css.="<link rel=\"stylesheet\" href=\"core/dev/css/pagecss/".$page.".css\" type=\"text/css\" />\n";
		
		
		return $css;
		
	}
	
	
	function charg_favicon()
	{
		$css="";
		
		if(isset($this->conf['packagecss']))
			$css.="<link rel='icon' type='image/png' href='core/design/packagecss/".$this->conf['packagecss']."/img/favicon.ico' />";
	
		return $css;
	}
	
	
	function charg_mail_css()
	{
		$css="";
		
		//chargement de la css
		$tab=array();
		if(isset($this->conf['mailcss']))
			$tab=$this->charg_dossier_dans_tab('core/src/pratiklib/mail/css/'.$this->conf['mailcss']);
		
		if(isset($tab))
			foreach($tab as $fich)
			{
				if(substr($fich,-3)=="css")
					$css.="<link rel=\"stylesheet\" href=\"".$fich."\" type=\"text/css\" />\n";
			}
		
		return $css;
		
	}
	
}



?>