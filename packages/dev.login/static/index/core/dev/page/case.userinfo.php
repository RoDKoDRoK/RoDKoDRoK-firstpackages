<?php

/*
to view the initer :
echo $this->showIniter();

*/


$instanceCaseCour=new CaseUserInfo($this->initer);

$tabuserinfo=$instanceCaseCour->userinfo_loader();
$this->tplcase->remplir_template("tabuserinfo",$tabuserinfo);



?>