			
	
				

	
<?php


/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$this->initer['mainsubtitle']="Saisir ".$this->instanceLang->getTranslation('shared package');

//get var
$typeform=$this->instanceVar->varget("typeform");
$id=$this->instanceVar->varget("id");


//prepare data
$tabaction=array();
$tabaction[]="todb";

$params=array();
$params['id']=$id;
$params['table']="sharedpackage";
$params['backlink']="index.php?page=listsharedpackage";
if($typeform=="update")
	$params['backlink']="index.php?page=viewsharedpackage&id=".$id;


$instancePage=new FormSharedpackage($this->initer);


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
