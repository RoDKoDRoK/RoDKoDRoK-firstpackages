<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/


$this->initer['mainsubtitle']="Globe";


$instancePage=new Globe($this->initer);


$content="";
//$content.=$this->showIniter();

//submiter
$content.=$instancePage->form_submiter();


$form=$instancePage->form_loader();
$this->tpl->remplir_template("form",$form);

$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

$globe=$instancePage->globe_loader();
$this->tpl->remplir_template("globe",$globe);


?>