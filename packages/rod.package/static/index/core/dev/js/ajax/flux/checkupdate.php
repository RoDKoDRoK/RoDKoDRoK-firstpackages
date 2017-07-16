<?php

/*
to view the initer :
echo $this->showIniter();

*/


$instanceAjax=new CheckUpdate($this->initer);


$form=$instanceAjax->form_loader();
$this->tpl->remplir_template("form",$form);

$windowtitle=$instanceAjax->windowtitle_loader();
$this->tpl->remplir_template("windowtitle",$windowtitle);

$windowcontent=$instanceAjax->windowcontent_loader();
$this->tpl->remplir_template("windowcontent",$windowcontent);


?>