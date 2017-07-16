<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/


$instancePage=new Error($this->initer);


$content="";
//$content.=$this->showIniter();

$content.=$instancePage->content_loader();

$this->tpl->remplir_template("content",$content);



?>