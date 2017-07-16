<?php

class PratikMail extends ClassIniter
{
	var $tpl;
	
	var $mailbrut="";
	var $mailhtml="";
	
	var $objet="";
	

	function __construct($initer=array())
	{
		parent::__construct($initer);
		
		$instanceTpl=new Tp($this->conf,$this->log);
		$tpl=$instanceTpl->tpselected;
	
		$this->tpl=$tpl;
		
		//récup css mail html
		$classe=new Css($this->conf,"mail"); //to replace with codeloader ???
		$css=$classe->returned;
		$this->tpl->remplir_template("css",$css);
	}
	
	
	
	function construct_mail($typemail="alert",$data=array(),$contentmailtpl="mainmailcontent",$mailtpl='mainmail')
	{
		$this->tpl->remplir_template("contentmailtpl",$contentmailtpl);
		
		if(file_exists($this->arkitect->get("pratiklib.mail").$this->arkitect->get("ext.pratikmail.class")."/class.".$contentmailtpl.".php"))
			include $this->arkitect->get("pratiklib.mail").$this->arkitect->get("ext.pratikmail.class")."/class.".$contentmailtpl.".php";
		include $this->arkitect->get("pratiklib.mail").$this->arkitect->get("ext.pratikmail.loader")."/".$contentmailtpl.".php";
		
		$this->mailbrut=$this->tpl->get_template($this->arkitect->get("pratiklib.mail")."/".$mailtpl.".brut.tpl");
		$this->mailhtml=$this->tpl->get_template($this->arkitect->get("pratiklib.mail")."/".$mailtpl.".html.tpl");
	}
	
	
	
	function send_mail($titre="Test",$tab_dest=null)
	{
		$result=array();
		
		//sender
		$sender['pseudo']=$this->conf['sender'];
		$sender['mail']=$this->conf['sendermail'];
	
		//create mail
		$frontiere = '-----=' . md5(uniqid(mt_rand()));
		
		$header="";
		$header.="From: ".$sender['pseudo']." <".$sender['mail'].">\n";
		
		$content="";
		$content.='This is a multi-part message in MIME format.'."\n\n";
		
		$content.='--'.$frontiere."\n";
		$content.='Content-Type: text/plain; charset="iso-8859-1"'."\n";
		$content.='Content-Transfer-Encoding: 8bit'."\n\n";
		$content.=$this->mailbrut;
		$content.="\n\n";
		
		$content.='--'.$frontiere."\n";
		$content.='Content-Type: text/html; charset="iso-8859-1"'."\n";
		$content.='Content-Transfer-Encoding: 8bit'."\n\n";
		$content.=$this->mailhtml;
		$content.="\n\n";
		
		$content.='--'.$frontiere."--";
		
		
		//send
		foreach($tab_dest as $dest)
		{
			if(mail($dest, $titre, $content, $header))
				$result[]=$this->lang['mail_ok']." ".$dest;
			else
				$result[]=$this->lang['mail_echec']." ".$dest;
		}
		
		return $result;
	}


	
	
	
}



?>