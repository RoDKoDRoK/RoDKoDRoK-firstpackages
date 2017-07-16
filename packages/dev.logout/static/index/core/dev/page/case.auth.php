<?php

/*
to view the initer :
echo $this->showIniter();

*/


$instanceCaseCour=new CaseAuth($this->initer);

$content=$instanceCaseCour->content_loader();
$this->tplcase->remplir_template("content",$content);



?>