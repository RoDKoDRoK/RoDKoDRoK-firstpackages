<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']="Form example";

$instancePage=new Formexample($this->initer);

//submiter
$tabaction=array();
$tabaction[]="todb";
//$tabaction[]="tomail";
//$tabaction[]="toconf";

$instancePage->form_submiter($tabaction);


//content
$content="";
//$content.=$this->showIniter();
$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

$form=$instancePage->form_loader();
$this->tpl->remplir_template("form",$form);



?>