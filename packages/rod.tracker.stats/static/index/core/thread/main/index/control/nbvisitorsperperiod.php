<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']=$this->instanceLang->getTranslation("Visitors");


$instancePage=new NbVisitorsPerPeriod($this->initer);

$content="";
//$content.=$this->showIniter();

$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

$graph=$instancePage->graph_loader();
$this->tpl->remplir_template("graph",$graph);


?>