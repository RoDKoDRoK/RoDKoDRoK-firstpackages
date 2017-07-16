<?php

{if $instancecour.type == "table"}

/*
to view the initer :
echo $this->showIniter();

*/


$instanceWs=new {$classnom}($this->initer);


$data=$instanceWs->data_loader();
$this->tpl->remplir_template("data",$data);


$coderesult=$instanceWs->coderesult;
$this->tpl->remplir_template("coderesult",$coderesult);


{/if}
?>