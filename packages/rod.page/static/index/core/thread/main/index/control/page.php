<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/


$this->initer['mainsubtitle']="Page manager";


$instancePage=new Page($this->initer);


$content="";
//$content.=$this->showIniter();

//submiter
$content.=$instancePage->form_submiter();


$form=$instancePage->form_loader();
$this->tpl->remplir_template("form",$form);

$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

$data=$instancePage->data_loader();
$this->tpl->remplir_template("data",$data);


?>