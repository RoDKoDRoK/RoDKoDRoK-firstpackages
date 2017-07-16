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
	$instanceCodeSrc->addCodeSrc('class','class','class','phpclass');
	$instanceCodeSrc->addCodeSrcToChain('class','all','1');
	
}


?>