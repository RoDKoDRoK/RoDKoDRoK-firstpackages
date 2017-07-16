<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']="Example";
//use $this->initer['varname'] to update and $this->varname to use or print
//if your update doesnt work, add a $this->reloadIniter(); line after your changements

$instancePage=new Example($this->initer);


$content="";
//$content.=$this->showIniter();
$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);


//example mail
if($this->includer->include_pratikclass("mail"))
{
	$instanceMail=new PratikMail($this->initer);
	$data=array("objet"=>"Test","texte"=>"Text test");
	$instanceMail->construct_mail("custom",$data); //,"mainmailcontent","mainmail");
	//$resultsentmail=$instanceMail->send_mail($instanceMail->objet,array("rodolpheboury@gmail.com"));
	//print_r($resultsentmail);
}


?>