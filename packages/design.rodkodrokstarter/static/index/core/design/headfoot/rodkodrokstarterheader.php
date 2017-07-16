<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$headercontent.=$this->showIniter();

*/


//menu
$menuheader="";
if($this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	$menuheader=$instanceMenu->menu_loader("main");
}

$this->tpl->remplir_template("menuheader",$menuheader);


//case
$caseauth="";
$caseuserinfo="";
if($this->includer->include_pratikclass("case"))
{
	$instanceCase=new PratikCase($this->initer);
	
	$caseauth=$instanceCase->case_loader("logintoprightcase");
	$caseuserinfo=$instanceCase->case_loader("loggedtoprightcase");
}

$this->tpl->remplir_template("caseauth",$caseauth);
$this->tpl->remplir_template("caseuserinfo",$caseuserinfo);


//colonne
$colonnedroite="";
$colonnegauche="";
if($this->includer->include_pratikclass("colonne"))
{
	$instanceColonne=new PratikColonne($this->initer);

	$colonnedroite=$instanceColonne->colonne_loader("colonnedroite");
	$colonnegauche=$instanceColonne->colonne_loader("colonnegauche");
}

$this->tpl->remplir_template("colonnedroite",$colonnedroite);
$this->tpl->remplir_template("colonnegauche",$colonnegauche);


//content header
$instanceHeader=new RodkodrokHeader($this->initer);

$headercontent=$instanceHeader->headercontent_loader();
$this->tpl->remplir_template("headercontent",$headercontent);



?>