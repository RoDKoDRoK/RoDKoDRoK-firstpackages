<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$footercontent.=$this->showIniter();

*/


//menu
$menufooter="";
if($this->includer->include_pratikclass("menu"))
{
	$instanceMenu=new PratikMenu($this->initer);
	
	$menufooter=$instanceMenu->menu_loader("footer");
}

$this->tpl->remplir_template("menufooter",$menufooter);




$instancePage=new YourFooter($this->initer);

$footercontent="";
//$footercontent.=$this->showIniter();
$footercontent.=$instancePage->footercontent_loader();
$this->tpl->remplir_template("footercontent",$footercontent);



?>