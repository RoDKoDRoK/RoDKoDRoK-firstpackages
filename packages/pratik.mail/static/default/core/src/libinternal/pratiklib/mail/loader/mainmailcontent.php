<?php

/*
var disponibles :
$typemail (nom type mail)
$data (array)

var to set :
$this->objet (objet du mail)


to view the initer :
echo $this->showIniter(true); exit;

*/


$instanceMailLoader=new MainMailContent($this->initer,$typemail,$data);

$mailcontent=$instanceMailLoader->content_loader();
$this->tpl->remplir_template("mailcontent",$mailcontent);

//récup objet du mail
$this->objet=$instanceMailLoader->objet_loader();


?>