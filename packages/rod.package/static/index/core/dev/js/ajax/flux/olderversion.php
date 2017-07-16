<?php

/*
to view the initer :
echo $this->showIniter();

*/


$instanceAjax=new OlderVersion($this->initer);


$data=$instanceAjax->data_loader();
$this->tpl->remplir_template("data",$data);

$form=$instanceAjax->form_loader();
$this->tpl->remplir_template("form",$form);

$windowtitle=$instanceAjax->windowtitle_loader();
$this->tpl->remplir_template("windowtitle",$windowtitle);

$windowcontent=$instanceAjax->windowcontent_loader();
$this->tpl->remplir_template("windowcontent",$windowcontent);


?>