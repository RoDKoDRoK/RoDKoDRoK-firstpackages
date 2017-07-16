<?php

/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']="Supprimer ".$this->instanceLang->getTranslation('{$classnom}');

//get var
$typeform="delete";
$id=$this->instanceVar->varget("id");


//prepare data
$tabaction=array();
$tabaction[]="deldb";

$params=array();
$params['id']=$id;
$params['table']="{$tablenom}";
$params['backlink']="index.php?page=view{$tablenom}&id=".$id;


$instancePage=new Form{$classnom}($this->initer);


$content="";
//$content.=$this->showIniter();


//actions apres submit du form
$content.=$instancePage->form_submiter($typeform,$tabaction,$params);


//creation du form
$form=$instancePage->form_loader($typeform,$params);
$this->tpl->remplir_template("form",$form);


$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);


?>