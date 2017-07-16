<?php



$elmtinitertostr=$this->instanceVar->varpost("elmtinitertostr");
$indent=$this->instanceVar->varpost("indent");

//recup values starting with get
$getparams=array();
foreach($_POST as $idpostcour=>$valuepostcour)
 if(substr($idpostcour,0,3)=="get")
	$getparams[substr($idpostcour,3)]=$valuepostcour;


$instanceAjax=new Showiniter($this->initer);


$content=$instanceAjax->content_loader($elmtinitertostr,$indent,$getparams);
$this->tpl->remplir_template("content",$content);


?>