<?php 

/*
to view the initer :
echo $this->showIniter(true); exit;

*/

//ajout du codesrc dans la db
if(isset($this->includer) && $this->includer->include_pratikclass("codesrc"))
{
	$instanceCodeSrc=new PratikCodesrc($this->initer);
	
	//codesrc
	$instanceCodeSrc->addCodeSrc('js','js','js','js');
	$instanceCodeSrc->addCodeSrcToChain('js','all','2');
	
}


?>