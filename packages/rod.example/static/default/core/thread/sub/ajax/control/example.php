<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/


$instanceAjax=new Example($this->initer);


$content="";
//$content.=$this->showIniter();
$content.=$instanceAjax->content_loader();
$this->tpl->remplir_template("content",$content);

/*
//ou bien selon tpl
$data=$instanceAjax->data_loader();
$this->tpl->remplir_template("data",$data);
*/


?>