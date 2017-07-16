<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']=$this->instanceLang->getTranslation('{$classnom}');

$instancePage=new {$classnom}($this->initer);


$data=$instancePage->data_loader();
$this->tpl->remplir_template("data",$data);


$content="";
//$content.=$this->showIniter();
$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);


?>