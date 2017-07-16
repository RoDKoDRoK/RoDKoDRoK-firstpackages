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
	$instanceCodeSrc->addCodeSrc('css','css','css','css');
	$instanceCodeSrc->addCodeSrcToChain('css','all','3');
}


?>