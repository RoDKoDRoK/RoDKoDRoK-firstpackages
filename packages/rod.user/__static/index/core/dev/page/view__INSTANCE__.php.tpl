<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$id=$this->instanceVar->varget("id");


$instancePage=new {$classnom}($this->initer);


$data=$instancePage->data_loader($id);
$this->tpl->remplir_template("data",$data);

$this->initer['mainsubtitle']=$this->instanceLang->getTranslation('{$classnom}')." - ".$data[0]['pseudo'];


$content="";
//$content.=$this->showIniter();
$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);


?>