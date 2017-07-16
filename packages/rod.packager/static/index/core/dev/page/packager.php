<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

//$reload=$this->instanceVar->varpost("reload");
//$reload=$this->instanceVar->vartotmpsession($reload);


$this->initer['mainsubtitle']="Packager";


$instancePage=new Packager($this->initer);

//sync package in folder and db
//if(isset($reload) && $reload!="canceled")
//	$instancePage->check_new_package();

$content="";
//$content.=$this->showIniter();

//submiter
$content.=$instancePage->form_submiter();


$form=$instancePage->form_loader();
$this->tpl->remplir_template("form",$form);

$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

$data=$instancePage->data_loader();
$data=$this->instanceLang->getTranslation($data);
$this->tpl->remplir_template("data",$data);



?>