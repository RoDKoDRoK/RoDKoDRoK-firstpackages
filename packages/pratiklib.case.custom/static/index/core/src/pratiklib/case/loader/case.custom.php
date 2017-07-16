<?php

/*
to view the initer :
echo $this->showIniter();

*/


$instanceCaseCour=new CaseCustom($this->initer);

$customcontent=$instanceCaseCour->content_loader();
$this->tplcase->remplir_template("customcontent",$customcontent);



?>