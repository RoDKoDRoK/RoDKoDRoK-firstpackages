<?php

/*
to view the initer :
echo $this->showIniter();

*/


$instanceWs=new Example($this->initer);


$coderesult=$instanceWs->coderesult;
$this->tpl->remplir_template("coderesult",$coderesult);

$data=$instanceWs->data_loader();
$this->tpl->remplir_template("data",$data);



?>