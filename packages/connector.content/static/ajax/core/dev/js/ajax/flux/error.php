<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/


$instanceAjax=new Error($this->initer);


$coderesult=$instanceAjax->coderesult;
$this->tpl->remplir_template("coderesult",$coderesult);

$content="";
//$content.=$this->showIniter();

$content.=$instanceAjax->content_loader();

$this->tpl->remplir_template("content",$content);


?>