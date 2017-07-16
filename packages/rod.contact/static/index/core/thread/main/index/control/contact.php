<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']="Contact";

$instancePage=new Contact($this->initer);

//submiter
$tabaction=array();
$tabaction[]="tomail";

$instancePage->form_submiter($tabaction);


//content
$content="";
//$content.=$this->showIniter();
$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

$form=$instancePage->form_loader();
$this->tpl->remplir_template("form",$form);



?>