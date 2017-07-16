<?php

/*
to view the initer :
echo $this->showIniter();

*/

//get param
$param_menuname="";
if(isset($param['menuname']) && $param['menuname']!="")
	$param_menuname=$param['menuname'];

$param_menutpl="";
if(isset($param['menutpl']) && $param['menutpl']!="")
	$param_menutpl=$param['menutpl'];



$instanceCaseCour=new CaseMenu($this->initer);

$casemenu=$instanceCaseCour->menu_loader($param_menuname,$param_menutpl);
$this->tplcase->remplir_template("casemenu",$casemenu);



?>