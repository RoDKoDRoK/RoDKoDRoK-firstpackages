			
	
				

	
<?php


/*
to view the initer :
echo $this->showIniter();
or better way
uncomment in this file the line : //$content.=$this->showIniter();

*/

$id=$this->instanceVar->varget("id");


$instancePage=new Sharedpackage($this->initer);


$data=$instancePage->data_loader($id);
$this->tpl->remplir_template("data",$data);

$this->initer['mainsubtitle']=$this->instanceLang->getTranslation('Shared package')." - ".$data[0]['packagename'];


$content="";
//$content.=$this->showIniter();
$content.=$instancePage->content_loader();
$this->tpl->remplir_template("content",$content);

?>
